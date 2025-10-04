<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Clarifi;
use App\Models\Connect;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\Usability;
use App\Trait\QueryTrait;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use QueryTrait;

    public function allFeature()
    {
        $feature =  $this->latest(new Feature());
        return view('admin.backend.feature.all_feature')->with(compact('feature'));
    }

    public function addFeature()
    {
        return view('admin.backend.feature.add_feature');
    }

    public function storeFeature(Request $request)
    {
        try {
            $data =  $request->validate([
                "title" => 'required|string|unique:features,title',
                "icon" => 'required|string',
                'description' => 'required|string'
            ]);
            Feature::create($data);
            $notification = array(
                'message' => 'added data successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.feature')->with($notification);
        } catch (\Exception $e) {

            $notification = array(
                'message' => 'Something Went Wrong:' . $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function editFeature($id)
    {
        $feature = $this->getitemById(new Feature(), $id);
        return view('admin.backend.feature.edit_feature')->with(compact('feature'));
    }


    public function updateFeature(Request $request)
    {
        try {
            $feature = $this->getitemById(new Feature(), $request->id);
            $data =  $request->validate([
                "title" => 'required|string|unique:features,title,' . $request->id,
                "icon" => 'required|string',
                'description' => 'required|string'
            ]);
            $feature->update($data);
            $notification = array(
                'message' => 'update data successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.feature')->with($notification);
        } catch (\Exception $e) {

            $notification = array(
                'message' => 'Something Went Wrong:' . $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function deleteFeature($id)
    {
        try {
            $feature = $this->getitemById(new Feature(), $id);
            $feature->delete();

            $notification = array(
                'message' => 'delete data successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.feature')->with($notification);
        } catch (\Exception $e) {

            $notification = array(
                'message' => 'Something Went Wrong:' . $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function clarifies()
    {
        try {
            $clarifi = $this->getitemById(new Clarifi(), 1);
            return view('admin.backend.clarifi.get_clarifi')->with(compact('clarifi'));
        } catch (\Exception $e) {
            $notification = array(
                'message' => 'Something Went Wrong:' . $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }


    public function updateClarifies(Request $request)
    {
        try {
            $clarifi = $this->getitemById(new Clarifi(), $request->id);

            $request->validate([
                'title' => 'sometimes|min:5',
                'image' => 'sometimes|mimes:png,jpg',
                'description' => 'sometimes|string',
            ]);

            $path = $clarifi->image;
            if ($request->hasFile('image')) {
                $path =  $this->updateImage('clarifi', $request->image, $path);
            }


            $clarifi->update([
                'title' => $request->title,
                'image' => $path,
                'description' => $request->description,
            ]);

            return redirect()->back()->with(compact('clarifi'));
        } catch (\Exception $e) {
            $notification = array(
                'message' => 'Something Went Wrong:' . $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function getUsability()
    {
        $usability = $this->getitemById(new Usability(), 1);
        return view('admin.backend.usability.get_usability', [
            'usability' => $usability
        ]);
    }



    public function updateUsability(Request $request)
    {
        try {
            $usability = $this->getitemById(new Usability(), $request->id);

            $request->validate([
                'title' => 'sometimes|min:5',
                'image' => 'sometimes|mimes:png,jpg',
                'description' => 'sometimes|string',
                'youtube' => 'sometimes|url',
                'link' => 'sometimes|url',
            ]);

            $path = $usability->image;
            if ($request->hasFile('image')) {
                $path =  $this->updateImage('usability', $request->image, $path);
            }


            $usability->update([
                'title' => $request->title,
                'image' => $path,
                'description' => $request->description,
                'youtube' => $request->youtube,
                'link' => $request->link,
            ]);

            return redirect()->back()->with(compact('usability'));
        } catch (\Exception $e) {
            $notification = array(
                'message' => 'Something Went Wrong:' . $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }












    public function getConnect()
    {
        $connect = $this->latest(new Connect());
        return view("admin.backend.connect.all_connect", [
            'connect' => $connect
        ]);
    }


    public function addConnect()
    {
        return view("admin.backend.connect.add_connect");
    }



    public function storeConnect(Request $request)
    {
        try {

            $request->validate([
                'title' => 'sometimes|min:5',
                'description' => 'sometimes|string',
            ]);




            Connect::create([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            $notification = array(
                'message' => 'add connect successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.connect')->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => 'Something Went Wrong:' . $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }


    /* used this function to update from Ajax Request */
    public function updateConnect(Request $request, $id)
    {
        $connect = Connect::findOrFail($id);
        if ($request->has('title')) {
            $connect->title = $request->title;
        }

        if ($request->has('description')) {
            $connect->description = $request->description;
        }

        $connect->save();
        return response()->json(['success' => true]);
    }
    /* used this function to update from Ajax Request */
    /* ******************************************************************** */

    public function allFaqs()
    {
        $faqs  = $this->latest(new Faq());
        return view("admin.backend.faqs.all_faqs")->with(compact('faqs'));
    }

    public function addFaqs()
    {
        return view("admin.backend.faqs.add_faqs");
    }


    public function editFaqs($id)
    {
        $faqs  = $this->getitemById(new Faq(), $id);

        return view("admin.backend.faqs.edit_faqs")->with(compact('faqs'));
    }



    public function storeFaqs(Request $request)
    {
        try {

            $request->validate([
                'title' => 'sometimes|min:5',
                'description' => 'sometimes|string',
            ]);




            Faq::create([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            $notification = array(
                'message' => 'add connect successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.faqs')->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => 'Something Went Wrong:' . $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }


    public function updateFaqs(Request $request)
    {
        try {
            $faqs = $this->getitemById(new Faq(), $request->id);

            $request->validate([
                'title' => 'sometimes|min:5',
                'description' => 'sometimes|string',
            ]);




            $faqs->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            $notification = array(
                'message' => 'updated successfully',
                'alert-type' => 'success'
            );

            return redirect()->route("all.faqs")->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => 'Something Went Wrong:' . $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function deleteFaqs($id)
    {
        $faqs = $this->getitemById(new Faq(), $id);
        $faqs->delete();
        return redirect()->back();
    }
}
