<?php

namespace Hjolfaei\Todo\Http\Controllers;


use Hjolfaei\Todo\Http\Traits\TodoFunctions;
use Hjolfaei\Todo\Models\Label;
use App\Http\Controllers\Controller;;
use Hjolfaei\Todo\Http\Resources\LabelsResource;
use Hjolfaei\Todo\Http\Requests\LabelsRequest;
use Illuminate\Support\Facades\Auth;

class LabelsController extends Controller
{
    use TodoFunctions;



    public function index()
    {
        $this->jsonAuth();
        $labels = Label::all();
        foreach ($labels as $key => $label){
            $labels -> $key = $this->getUserSingleLabelInfo($label);
        }
        return LabelsResource::collection($labels);

    }


    public function create()
    {
        //
    }


    public function store(LabelsRequest $labelsRequest)
    {
        #Create Label
       $this->jsonAuth();
        $label = Label::create([
            'name' => $labelsRequest->input('name')
        ]);
        return new LabelsResource($label);
    }


    public function show($id)
    {
        $user = $this->jsonAuth();
        $label = Label::find($id);
        validateLabel($label);
        return new LabelsResource($label);
    }


    public function edit(Label $label)
    {
        //
    }


    public function update(LabelsRequest $labelsRequest,$id)
    {
        $this->jsonAuth();
        $label = Label::find($id);
        validateLabel($label);
        $inputData = [
            'name' => $labelsRequest->input('name')
        ];
        $label->update($inputData);
        return new LabelsResource($label);
    }


    public function destroy($id)
    {
        return response(['message','You are not allowed to delete labels.']);
        $this->jsonAuth();
        $label = Label::find($id);
        validateLabel($label);
        if (!empty($label) && ($label instanceof Label)){
            $label->destroy();
            return response(['message','Label Removed.'],204);
        }

    }
}
