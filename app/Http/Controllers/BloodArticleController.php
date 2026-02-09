<?php

namespace App\Http\Controllers;

use App\Models\BloodArticle;
use Illuminate\Http\Request;

class BloodArticleController extends Controller
{

public function index()
    {
        $articles = BloodArticle::orderBy('created_at', 'desc')->get();
        return view('hospital_admin.blood-articles.index', compact('articles'));
    }

    public function create()
    {
        return view('hospital_admin.blood-articles.create');
    }

    public function edit(BloodArticle $bloodArticle)
    {
        return view('hospital_admin.blood-articles.edit', compact('bloodArticle'));
    }

    // edit article
    public function update(Request $request, BloodArticle $bloodArticle)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'hospital_name' => 'required|string|max:255',
            'blood_type' => 'required|string|max:10',
            'description' => 'required|string',
        ]);

        $bloodArticle->update($request->all());

        return redirect()->route('hospital_admin.blood-articles.index')->with('success', 'Blood article updated successfully.');
    }

     // delete article
     public function destroy(BloodArticle $bloodArticle)
     {
         $bloodArticle->delete();
         return redirect()->route('hospital_admin.blood-articles.index')->with('success', 'Blood article deleted successfully.');
     }

     // store new article
     public function store(Request $request)
     {
         $request->validate([
             'title' => 'required|string|max:255',
             'date' => 'required|date',
             'hospital_name' => 'required|string|max:255',
             'blood_type' => 'required|string|max:10',
             'description' => 'required|string',
         ]);

         BloodArticle::create($request->all());

         return redirect()->route('hospital_admin.blood-articles.index')->with('success', 'Blood article created successfully.');
     }

      // store new article from hospital admin dashboard

    public function storeFromDashboard(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'hospital_name' => 'required|string|max:255',
            'blood_type' => 'required|string|max:10',
            'description' => 'required|string',
        ]);

        BloodArticle::create($request->all());

        return redirect()->back()->with('success', 'Blood article created successfully.');
    }
}
