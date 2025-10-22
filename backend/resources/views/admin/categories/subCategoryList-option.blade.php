<?php $dash .='&nbsp;&nbsp;&nbsp;&nbsp;'; ?>
@foreach($subcategories as $subcategory)
    <option value="{{$subcategory->id}}" class="{{(count($subcategory->subcategory)>0)?'category-second':''}}" {{(isset($pdetail->category_id) && $pdetail->category_id==$subcategory->id)?'selected':''}}>{!! $dash !!}{{$subcategory->name}}</option>
    @if(count($subcategory->subcategory))
        @include('admin.subCategoryList-option',['subcategories' => $subcategory->subcategory])
    @endif
@endforeach