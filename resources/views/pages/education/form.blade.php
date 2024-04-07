@php
    $education = $educations ?? null;
@endphp

@csrf
            <div class="row mb-3" style="margin-left: 10px; margin-top: 15px">
                <div class="col-sm-4">
                    <div  class="upload-container" style="text-align: center; display: flex; justify-content: center; align-items: center;">
                        <div class="upload-button-edit" >
                            <img src="/assets/educations/{{$education->image}}" id="previewImg" style="max-width: 100%; max-height: 100%; height: auto;">
                            <input type="hidden" id="inputImg" name="inputImg" >
                            <input type="file" id="fileInput-edit" name="fileInput-edit" style="display:none" onchange="handleFileUpload2(this)" >
                        </div>
                    </div>
                </div>

                <div class="col-sm-8" style="margin-top: 10px">
                    <div class="mb-3" style="font-size: 14px;">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="title" value="{{ old('title', $education->title) }}" name="title">
                    </div>

                    <div class="mb-3" style="font-size: 14px; display: flex; flex-direction: column;">
                        <label for="category_id" class="form-label" style="margin-bottom: 5px;">Kategori</label>
                        <div style="display: flex;">
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" aria-label="Pilih Kategori" id="category_id" style="width: 100%; margin-right: 10px;">
                                <option>-- Pilih --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if($category->id == $education->category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary col-md-2" style="font-size: 12px; margin-left: 5px">New Category</button>
                        </div>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control"  id="floatingTextarea2" style="height: 120px">{{ $education? $education->content : '' }}</textarea>
                        <label for="floatingTextarea2">Contents</label>
                    </div>
                </div>
            </div>


            <div style="text-align: end;">
                <button type="submit" class="btn btn-primary"  style="font-size: 12px;" id="btn-submit" name="btn-submit" >Simpan</button>
                <input type="hidden" id="content" name="content">
            </div>
@push('script')
    <script>
        $('#category_id').select2();
    </script>
@endpush
