<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CourseController extends Controller {
    public function show($id) {
        $course = Course::with(['plateform', 'topics', 'series'])->findOrFail($id);
        return $course;
    }
}
