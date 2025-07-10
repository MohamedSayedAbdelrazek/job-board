<?php

namespace App\Services;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToText\Pdf;
use Illuminate\Support\Facades\Http;

class ResumeAnalysisService
{
    public function extractResumeInformation(string $fileUrl)
    {
        try{
        // Extract raw text from the resume PDF file
        $rawText = $this->extractTextFromPdf($fileUrl);
        Log::debug('Successfully extracted text from pdf file, size: ' . strlen($rawText) . ' characters');

        // Use OpenRouter API to organize the text into a structured format
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => 'mistralai/mistral-7b-instruct',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => "You are a precise resume parser. Extract information exactly as it appears in the resume without adding any interpretation or extra information. The output should be in JSON format."
                ],
                [
                    'role' => 'user',
                    'content' => "Parse the following resume content and extract the information as a JSON object with the exact keys: 'summary', 'skills', 'experience', 'education'. The resume content is: {$rawText}. Return an empty string for any key that is not found."
                ]
            ],
            'temperature' => 0.1
        ]);

        // Check if request was successful
        if (!$response->ok()) {
            Log::error('OpenRouter API request failed: ' . $response->body());
            throw new \Exception('Failed to connect to OpenRouter API');
        }

        $result = $response['choices'][0]['message']['content'] ?? '';
        Log::debug("OpenRouter response: " . $result);

        // Parse JSON output
        $parsedResult = json_decode($result, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('Failed to parse OpenRouter response: ' . json_last_error_msg());
            throw new \Exception('Failed to parse OpenRouter response');
        }

        // Validate required keys
        $requiredKeys = ['summary', 'skills', 'experience', 'education'];
        $missingKeys = array_diff($requiredKeys, array_keys($parsedResult));

        if (count($missingKeys) > 0) {
            Log::error('Missing required keys: ' . implode(', ', $missingKeys));
            throw new \Exception('Missing required keys in the parsed result');
        }

        return [
            'summary' => $parsedResult['summary'] ?? '',
            'skills' => $parsedResult['skills'] ?? '',
            'experience' => $parsedResult['experience'] ?? '',
            'education' => $parsedResult['education'] ?? ''
        ];
        } catch(\Exception $e) {
            Log::error("Error Extracting Resume Information".$e->getMessage());
              return [
            'summary' =>'',
            'skills' => '',
            'experience' => '',
            'education' => ''
        ];
        }
    }

    private function extractTextFromPdf(string $fileUrl)
    {
        //Spatie PDF extract text
        //Reading the file from the cloud to local disk storage in temp file
        $tempFile = tempnam(sys_get_temp_dir(), 'resume');
        $filePath = parse_url($fileUrl, PHP_URL_PATH);
        if (!$filePath) {
            throw new \Exception('Invalid file URL');
        }

        $filename = basename($filePath);
        $storagePath = "resumes/{$filename}";

        if (!Storage::disk('cloud')->exists($storagePath)) {
            throw new \Exception('Invalid file URL');
        }

        $pdfContent = Storage::disk('cloud')->get($storagePath);
        if (!$pdfContent) {
            throw new \Exception('Failed to read file.');
        }

        file_put_contents($tempFile, $pdfContent);

        //check if pdf-to-text is installed

        $pdfToTextPath = ['/opt/homebrew/bin/pdftotext', '/usr/bin/pdftotext', '/usr/local/bin/pdftotext'];
        $pdfToTextAvailable = false;

        foreach ($pdfToTextPath as $path) {
            if (file_exists($path)) {
                $pdfToTextAvailable = true;
                break;
            }
        }
        if (!$pdfToTextAvailable) {
            throw new \Exception('pdf-to-text is not installed');
        }

        //Extract text from the pdf file

        $instance = new Pdf();
        $instance->setPdf($tempFile);
        $text = $instance->text();

        unlink($tempFile);
        return $text;
    }
}