<?php

namespace App\Repository\Admin;

use App\Models\Education;
use Illuminate\Support\Facades\Storage;

class EducationRepo{
    public static function save(array $data, ?Education $education = null)
    {
        if (isset($data['image']))
            $data['image'] = $data['image']->storePublicly('educations', 'public');

        if ($education && isset($data['image']))
            Storage::disk('public')->delete($education->image);

        if ($education) {
            $education->update($data);
            return $education;
        }

        return Education::create($data);
    }
}
