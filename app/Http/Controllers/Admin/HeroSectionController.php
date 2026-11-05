<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSectionController extends Controller
{
    public function edit()
    {
        $hero = HeroSection::where('section', 'home')->firstOrFail();

        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request)
    {
        $hero = HeroSection::where('section', 'home')->firstOrFail();

        $data = $request->validate([

            'headline' => 'required|string|max:160',

            'description' => 'required|string|max:2000',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:5120',

            'primary_button_text' => 'required|string|max:80',
            'primary_button_url' => [
                'required', 'string', 'max:2048',
                'regex:/^(#|\/|https?:\/\/)/i',
            ],

            'secondary_button_text' => 'required|string|max:80',
            'secondary_button_url' => [
                'required', 'string', 'max:2048',
                'regex:/^(#|\/|https?:\/\/)/i',
            ],

            'stat_1_value' => 'required|string|max:30',
            'stat_1_label' => 'required|string|max:80',

            'stat_2_value' => 'required|string|max:30',
            'stat_2_label' => 'required|string|max:80',

            'stat_3_value' => 'required|string|max:30',
            'stat_3_label' => 'required|string|max:80',
        ]);

        $oldImage = $hero->image_path;

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')
                ->store('hero', 'public');
        }

        unset($data['image']);

        $hero->update($data);

        // Delete old image only after the database update succeeds.
        if (
            ! empty($data['image_path']) &&
            $oldImage
        ) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()
            ->route('admin.hero.edit')
            ->with('success', 'Hero section updated successfully!');
    }
}
