<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductDocumentation;
use App\Models\SupportingDocument;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class ProductDocumentationController extends Controller
{
    public function index()
    {
        $docs = ProductDocumentation::with('supportingDocuments')->get();
        return view('admin.docs.index', compact('docs'));
    }
     public function alphabetical()
    {
        $products = ProductDocumentation::select('name', 'slug')
            ->orderBy('name')
            ->get();

        $grouped = [];

        foreach ($products as $product) {
            $firstLetter = strtoupper(Str::substr($product->name, 0, 1));

            if (!isset($grouped[$firstLetter])) {
                $grouped[$firstLetter] = [];
            }

            $grouped[$firstLetter][] = [
                'name' => $product->name,
                'slug' => $product->slug,
            ];
        }

        ksort($grouped); // Sort alphabetically by letter

        return response()->json($grouped);
    }

    public function create()
    {
        return view('admin.docs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'name' => ['required', 'string', 'max:255'],
        //'code' => ['required', 'string', 'max:100'],
        //'category' => ['required', 'string', 'max:100'],
        'attributes' => ['nullable', 'string'],
        'packaging' => ['nullable', 'string'],
        'grades' => ['nullable', 'string'],
        'notes' => ['nullable', 'string'],
        'image' => ['nullable', 'image', 'max:2048'], // 2MB max
        'certification' => ['nullable', 'image', 'max:2048'],
        'supporting_documents.*.name' => ['nullable', 'string', 'max:255'],
        'supporting_documents.*.file' => ['nullable', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:4096'], // 4MB max
    ]);
        $baseSlug = Str::slug($request->input('name'));
        $slug = $baseSlug;
        $counter = 1;

        while (ProductDocumentation::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }



        $data = $request->except(['supporting_documents', 'image', 'certification']);
        $data['slug'] = $slug;
        // Handle main image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('product_images', 'public');
        }

        // Handle certification image upload
        if ($request->hasFile('certification')) {
            $data['certification'] = $request->file('certification')->store('certifications', 'public');
        }

        // Create the product documentation
        $doc = ProductDocumentation::create($data);


        if ($request->has('supporting_documents')) {
            foreach ($request->supporting_documents as $docData) {
                if (isset($docData['file'])) {
                    $path = $docData['file']->store('supporting_docs', 'public');
                    $doc->supportingDocuments()->create([
                        'document_id' =>$doc->id,
                        'name' => $docData['name'] ?? 'Untitled',
                        'image' => $path,
                    ]);
                }
            }
        }
        return redirect()->route('admin.docs.index')->with('success', 'Documentation saved.');
    }

    public function edit($id)
    {
        $doc = ProductDocumentation::with('supportingDocuments')->findOrFail($id);
        return view('admin.docs.edit', compact('doc'));
    }

    public function update(Request $request, $id)
    { //echo "<pre>";print_r($request->supporting_documents);die;

        $request->validate([
        'name' => ['required', 'string', 'max:255'],
        //'code' => ['required', 'string', 'max:100'],
        //'category' => ['required', 'string', 'max:100'],
        'attributes' => ['nullable', 'string'],
        'packaging' => ['nullable', 'string'],
        'grades' => ['nullable', 'string'],
        'notes' => ['nullable', 'string'],
        'image' => ['nullable', 'image', 'max:2048'], // 2MB max
        'certification' => ['nullable', 'image', 'max:2048'],
        'supporting_documents.*.name' => ['nullable', 'string', 'max:255'],
        'supporting_documents.*.file' => ['nullable', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:4096'], // 4MB max
    ]);

        $doc = ProductDocumentation::findOrFail($id);
        $data = $request->except(['supporting_documents', 'image', 'certification']);

        // Replace image if uploaded
        if ($request->hasFile('image')) {
            if ($doc->image) Storage::disk('public')->delete($doc->image);
            $data['image'] = $request->file('image')->store('product_images', 'public');
        }

        // Replace certification if uploaded
        if ($request->hasFile('certification')) {
            if ($doc->certification) Storage::disk('public')->delete($doc->certification);
            $data['certification'] = $request->file('certification')->store('certifications', 'public');
        }

        $doc->update($data);


        // ✅ Delete documents not in submitted list
        $submittedIds = $request->existing_documents ?? [];
        $doc->supportingDocuments()->whereNotIn('id', $submittedIds)->each(function ($support) {
            if ($support->image) Storage::disk('public')->delete($support->image);
            $support->delete();
        });

        // ✅ Update names of existing documents
        foreach ($request->supporting_documents ?? [] as $docData) {
            if (isset($docData['id'])) {
                $support = SupportingDocument::find($docData['id']);
                if ($support && $support->document_id == $doc->id) {
                    $support->update(['name' => $docData['name']]);
                }
            }
        }

        // ✅ Add new documents only if file is uploaded
        foreach ($request->supporting_documents ?? [] as $docData) {
            if (!isset($docData['id']) && isset($docData['file'])) {
                $path = $docData['file']->store('supporting_docs', 'public');
                $doc->supportingDocuments()->create([
                    'document_id' => $doc->id,
                    'name' => $docData['name'] ?? 'Untitled',
                    'image' => $path,
                ]);
            }
        }




       

        // Add new supporting documents
       /* if ($request->has('supporting_documents')) {
             // Remove old supporting documents
            $doc->supportingDocuments()->delete();
            foreach ($request->supporting_documents as $docData) {
                if (isset($docData['file'])) {
                    $path = $docData['file']->store('supporting_docs', 'public');
                    $doc->supportingDocuments()->create([
                        'document_id' => $doc->id,
                        'name' => $docData['name'] ?? 'Untitled',
                        'image' => $path,
                    ]);
                }
            }
        }*/

        return redirect()->route('admin.docs.index')->with('success', 'Documentation updated.');
    }

    public function destroy($id)
    {
        $doc = ProductDocumentation::findOrFail($id);

        // Delete images
        if ($doc->image) Storage::disk('public')->delete($doc->image);
        if ($doc->certification) Storage::disk('public')->delete($doc->certification);

        // Delete supporting documents
        foreach ($doc->supportingDocuments as $support) {
            if ($support->image) Storage::disk('public')->delete($support->image);
        }

        $doc->delete();

        return back()->with('success', 'Documentation deleted.');
    }
    public function show($slug)
{
    $product = ProductDocumentation::with('supportingDocuments')
        ->where('slug', $slug)
        ->firstOrFail();

    return response()->json([
        'name' => $product->name,
        'code' => $product->code,
        'category' => $product->category,
        'attributes' => $product->attributes,
        'packaging' => $product->packaging,
        'grades' => $product->grades,
        'notes' => $product->notes,
        'image' => $product->image ? asset('storage/' . $product->image) : null,
        'certification' => $product->certification ? asset('storage/' . $product->certification) : null,
        'supporting_documents' => $product->supportingDocuments->map(function ($doc) {
            return [
                'name' => $doc->name,
                'file' => $doc->image ? asset('storage/' . $doc->image) : null,
            ];
        }),
    ]);
}

}