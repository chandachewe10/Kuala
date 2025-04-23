<?php

namespace App\Models;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use App\Models\OpenAIConfig;

class Claim extends Model implements HasMedia
{

    use InteractsWithMedia;
    


public function runAiValidation()
{
    $openAIconfigs = OpenAIConfig::latest()->first();
    if(!is_null($openAIconfigs) &&  $openAIconfigs->status == 'ACTIVE'){
    $prompt = $openAIconfigs->prompt;
    $response = Http::withToken($openAIconfigs->token)->post($openAIconfigs->base_uri.$openAIconfigs->endPoint, [
        'model' => $openAIconfigs->name,
        'messages' => [
            ['role' => 'system', 'content' => 'You are an insurance claim validator.'],
            ['role' => 'user', 'content' => $prompt],
        ],
        'temperature' => 0.4,
    ]);

    $aiOutput = $response->json('choices.0.message.content');

    $this->ai_feedback = [
        'raw' => $aiOutput,
    ];
    $this->save();
}
}


protected $casts = [
    'ai_feedback' => 'array',
];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'policy_number',
        'type',
        'incident_date',
        'incident_location',
        'description',
        'estimate_loss',
        'police_report_number',
        'witnesses',
        'ai_feedback',
        'userId',
        'attachment',
       
    ];
}
