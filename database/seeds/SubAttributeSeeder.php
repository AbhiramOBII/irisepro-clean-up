<?php

use Illuminate\Database\Seeder;
use App\SubAttribute;

class SubAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subAttributes = [
            // Attitude (attribute_id = 2)
            ['attribute_id' => 2, 'subattribute_name' => 'curiosity', 'status' => 'active'],
            ['attribute_id' => 2, 'subattribute_name' => 'optimism', 'status' => 'active'],
            ['attribute_id' => 2, 'subattribute_name' => 'regard_for_others', 'status' => 'active'],
            ['attribute_id' => 2, 'subattribute_name' => 'empathy', 'status' => 'active'],
            ['attribute_id' => 2, 'subattribute_name' => 'confidence', 'status' => 'active'],
            ['attribute_id' => 2, 'subattribute_name' => 'resilience', 'status' => 'active'],
            ['attribute_id' => 2, 'subattribute_name' => 'dynamic', 'status' => 'active'],
            ['attribute_id' => 2, 'subattribute_name' => 'open_mindedness', 'status' => 'active'],
            ['attribute_id' => 2, 'subattribute_name' => 'accountability', 'status' => 'active'],
            ['attribute_id' => 2, 'subattribute_name' => 'adaptability', 'status' => 'active'],
            ['attribute_id' => 2, 'subattribute_name' => 'growth_mindset', 'status' => 'active'],
            ['attribute_id' => 2, 'subattribute_name' => 'humility', 'status' => 'active'],
            ['attribute_id' => 2, 'subattribute_name' => 'steadfastness', 'status' => 'active'],
            ['attribute_id' => 2, 'subattribute_name' => 'self_reflection', 'status' => 'active'],
            ['attribute_id' => 2, 'subattribute_name' => 'courage', 'status' => 'active'],

            // Aptitude (attribute_id = 1)
            ['attribute_id' => 1, 'subattribute_name' => 'memory', 'status' => 'active'],
            ['attribute_id' => 1, 'subattribute_name' => 'concentration', 'status' => 'active'],
            ['attribute_id' => 1, 'subattribute_name' => 'attention_to_detail', 'status' => 'active'],
            ['attribute_id' => 1, 'subattribute_name' => 'critical_analytical_thinking', 'status' => 'active'],
            ['attribute_id' => 1, 'subattribute_name' => 'logical_reasoning', 'status' => 'active'],
            ['attribute_id' => 1, 'subattribute_name' => 'imagination', 'status' => 'active'],
            ['attribute_id' => 1, 'subattribute_name' => 'grasping_ability', 'status' => 'active'],
            ['attribute_id' => 1, 'subattribute_name' => 'mental_dexterity', 'status' => 'active'],
            ['attribute_id' => 1, 'subattribute_name' => 'self_awareness', 'status' => 'active'],
            ['attribute_id' => 1, 'subattribute_name' => 'self_regulation', 'status' => 'active'],
            ['attribute_id' => 1, 'subattribute_name' => 'problem_solving', 'status' => 'active'],
            ['attribute_id' => 1, 'subattribute_name' => 'verbal_ability', 'status' => 'active'],

            // Communication (attribute_id = 3)
            ['attribute_id' => 3, 'subattribute_name' => 'voice_tone_modulation', 'status' => 'active'],
            ['attribute_id' => 3, 'subattribute_name' => 'pronunciation', 'status' => 'active'],
            ['attribute_id' => 3, 'subattribute_name' => 'pitch', 'status' => 'active'],
            ['attribute_id' => 3, 'subattribute_name' => 'pacing_pause', 'status' => 'active'],
            ['attribute_id' => 3, 'subattribute_name' => 'structure', 'status' => 'active'],
            ['attribute_id' => 3, 'subattribute_name' => 'vocabulary', 'status' => 'active'],
            ['attribute_id' => 3, 'subattribute_name' => 'grammar', 'status' => 'active'],
            ['attribute_id' => 3, 'subattribute_name' => 'fluency', 'status' => 'active'],
            ['attribute_id' => 3, 'subattribute_name' => 'articulation', 'status' => 'active'],
            ['attribute_id' => 3, 'subattribute_name' => 'creativity', 'status' => 'active'],
            ['attribute_id' => 3, 'subattribute_name' => 'vocabulary_written', 'status' => 'active'],
            ['attribute_id' => 3, 'subattribute_name' => 'grammar_punctuation', 'status' => 'active'],
            ['attribute_id' => 3, 'subattribute_name' => 'legibility_handwriting', 'status' => 'active'],
            ['attribute_id' => 3, 'subattribute_name' => 'structure_written', 'status' => 'active'],
            ['attribute_id' => 3, 'subattribute_name' => 'spelling', 'status' => 'active'],
            ['attribute_id' => 3, 'subattribute_name' => 'creativity_written', 'status' => 'active'],
            ['attribute_id' => 3, 'subattribute_name' => 'body_language_posture', 'status' => 'active'],
            ['attribute_id' => 3, 'subattribute_name' => 'expression', 'status' => 'active'],
            ['attribute_id' => 3, 'subattribute_name' => 'gestures', 'status' => 'active'],
            ['attribute_id' => 3, 'subattribute_name' => 'active_listening', 'status' => 'active'],
            ['attribute_id' => 3, 'subattribute_name' => 'eye_contact', 'status' => 'active'],
            ['attribute_id' => 3, 'subattribute_name' => 'goal_setting', 'status' => 'active'],

            // Execution (attribute_id = 4)
            ['attribute_id' => 4, 'subattribute_name' => 'time_management', 'status' => 'active'],
            ['attribute_id' => 4, 'subattribute_name' => 'discipline', 'status' => 'active'],
            ['attribute_id' => 4, 'subattribute_name' => 'uniqueness', 'status' => 'active'],
            ['attribute_id' => 4, 'subattribute_name' => 'decision_making', 'status' => 'active'],
            ['attribute_id' => 4, 'subattribute_name' => 'bonding_with_others', 'status' => 'active'],
            ['attribute_id' => 4, 'subattribute_name' => 'conflict_resolution', 'status' => 'active'],
            ['attribute_id' => 4, 'subattribute_name' => 'receptiveness_to_feedback', 'status' => 'active'],
            ['attribute_id' => 4, 'subattribute_name' => 'mental_endurance', 'status' => 'active'],
            ['attribute_id' => 4, 'subattribute_name' => 'leadership_ability', 'status' => 'active'],
            ['attribute_id' => 4, 'subattribute_name' => 'efficiency', 'status' => 'active'],
            ['attribute_id' => 4, 'subattribute_name' => 'effectiveness', 'status' => 'active'],
            ['attribute_id' => 4, 'subattribute_name' => 'quality_management', 'status' => 'active'],
            ['attribute_id' => 4, 'subattribute_name' => 'dressing_personal_hygiene', 'status' => 'active'],
            ['attribute_id' => 4, 'subattribute_name' => 'planning', 'status' => 'active'],
            ['attribute_id' => 4, 'subattribute_name' => 'comprehension', 'status' => 'active'],
        ];

        foreach ($subAttributes as $subAttribute) {
            SubAttribute::create($subAttribute);
        }
    }
}
