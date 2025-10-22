<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Config;
use App\Models\ContactUs;
use App\Models\User;
class AdminController extends Controller
{
    public function dashboard()
    {
        // if (!Session::has('admin_id')) {
        //     return redirect()->route('admin.login')->with('error', 'Please login first.');
        // }

        return view('admin.dashboard');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('admin')->with('success', 'Logged out successfully.');
    }
    public function allUsers()
    {
        $allusers = User::all();
        return view('admin.user-list', compact('allusers'));
    }
    public function generalSettings()
    {
        $config = Config::all();
        return view('admin.settings', compact('config'));
    }
    public function updateSettings(Request $request)
    {
        $this->validate($request, [
            'value.*' => 'required',
        ]);
        //echo "<pre>";print_r($request->all());
        $variable = $request->all();
        foreach ($variable['value'] as $key => $value) {
            // echo $key.'---'.$value;die;
            $config = Config::find($key);
            $config->value = $value;
            $config->save();
        }

        $message = "<b>Configuration updated successfully</b>";
        return redirect()->back()->with(['success' => $message]);
    }
    public function createNewSettings()
    {

        return view('admin.add-settings');
    }
    public function createSettingsPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'value' => 'required',
        ]);
        $data = array(
            'name' => $request->name,
            'value' => $request->value
        );
        $job = Config::create($data);
        $message = "<b>Configuration saved successfully</b>";
        return redirect()->back()->with(['success' => $message]);
    }

    // public function generateSlugsForAllProducts()
    // {
    //     $products = Product::all();

    //     foreach ($products as $product) {
    //         $product->slug = Product::generateUniqueSlug($product->chemical_name, $product->id);
    //         $product->save();
    //     }

    //     return 'Slugs generated successfully!';
    // }

    public function addNews()
    {

        return view('admin.add-news');
    }
    public function ufcNews(Request $request)
    {
        $filter = [];
        if (!empty($request->status) && ($request->status == '1' || $request->status == '2')) {
            $filter['status'] = $request->status;
        }
        $newslist = News::where($filter)
            ->orderBy('id', 'DESC')
            ->get();
        return view('admin.news', compact('newslist'));
    }

    public function editNews($news_id)
    {
        if (Session::has('admin_id')) {
            $newsdetail = News::where(['id' => $news_id])->first();
            return view('admin.edit-news', compact('newsdetail', 'news_id'));
        } else {
            return redirect('/dashboard');
        }

    }

    public function updateNewsDetails(Request $request, $news_id)
    {
        if (Session::has('admin_id')) {
            $this->validate($request, [
                'news_title' => 'required',
                'description' => 'required',

            ]);
            $data = array(
                'title' => $request->news_title,
                'description' => $request->description
            );
            $message = "The news you are trying to access is not available";
            if (isset($news_id)) {
                $newsDetail = News::where(['id' => $news_id])->first();
                if ($newsDetail) {
                    $newsDetail->title = $request->news_title;
                    $newsDetail->description = $request->description;
                    if ($newsDetail->save()) {
                        $message = "<b>News updated successfully</b>";
                        return redirect()->back()->with(['success' => $message]);
                    }
                }
            }
            return redirect()->back()->with(['error' => $message]);

        } else {
            return redirect('/dashboard');
        }

    }

    public function addNewsPost(Request $request)
    {
        //echo "<pre>";print_r($request->all());die;
        $this->validate($request, [
            'news_title' => 'required',
            'description' => 'required',

        ]);
        $data = array(
            'title' => $request->news_title,
            'description' => $request->description
        );
        $news = News::create($data);
        $message = "<b>News submitted successfully</b>";
        return redirect()->back()->with(['success' => $message]);

    }


    public function updateNewsStatus($news_id)
    {
        if (Session::has('admin_id')) {

            if (isset($news_id)) {
                $newsDetail = News::where(['id' => $news_id])->first();
                if ($newsDetail) {
                    if ($newsDetail->status == '1') {
                        $newsDetail->status = '2';
                    } else {
                        $newsDetail->status = '1';
                    }

                    if ($newsDetail->save()) {
                        $message = "<b>News status updated successfully</b>";
                        return redirect()->back()->with(['success' => $message]);
                    }
                }
            }
            return redirect()->back()->with(['error' => $message]);

        } else {
            return redirect('/dashboard');
        }

    }
     public function all_contactrequests(Request $request)
    {
        $filter = [];
        if (!empty($request->status) && ($request->status == '1' || $request->status == '2')) {
            $filter['status'] = $request->status;
        }
        $contactlist = ContactUs::where($filter)
            ->orderBy('id', 'DESC')
            ->get();
        return view('admin.contact-us', compact('contactlist'));
    }

    public function updateContactUsStatus($contactUs_id)
    {
        if (Session::has('admin_id')) {

            $contactUsDetail = ContactUs::find($contactUs_id);

            if ($contactUsDetail) {
                $contactUsDetail->status = $contactUsDetail->status == 1 ? 2 : 1;

                if ($contactUsDetail->save()) {
                    $message = "<b>Contact's application status updated successfully.</b>";
                    return redirect()->back()->with(['success' => $message]);
                } else {
                    $errorMessage = "Something went wrong while updating the status.";
                    return redirect()->back()->with(['error' => $errorMessage]);
                }
            } else {
                $errorMessage = "Contact record not found.";
                return redirect()->back()->with(['error' => $errorMessage]);
            }

        } else {
            return redirect('/dashboard');
        }
    }

}
