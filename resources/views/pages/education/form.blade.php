@php
    $education = isset($education) ? $education : null;
@endphp

@csrf
            <div class="row mb-3" style="margin-left: 10px; margin-top: 15px">
                <div class="col-sm-4" style="margin-top: 15px">
                    <label class="image-preview " for="image" style="background-image: url('{{ Storage::url($education?->image) }}')">
                        <small>Klik untuk {{ $education ? 'mengganti' : 'mengunggah' }} foto</small>
                        <input type="file" name="image" id="image" class="d-none " accept="image/*">
                    </label>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="col-sm-8" style="margin-top: 10px">
                    <div class="mb-3" style="font-size: 14px;">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="title" value="{{ old('title', $education?->title) }}" name="title">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3" style="font-size: 14px; display: flex; flex-direction: column;">
                        <label for="category_id" class="form-label" style="margin-bottom: 5px;">Katagori</label>
                        <div class="row" style="display: flex; margin-left: 0px; margin-right: 0px">
                            <select name="category_id" class="form-select" aria-label="Pilih Kategori" id="category_id" style="width: 100%; margin-right: 10px;">
                                <option>-- Pilih --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if($category->id == $education?->category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" style="margin-left: -10px"></div>
                        </div>
{{--                        <div class="invalid-feedback"></div>--}}
                    </div>
                    <div class="form-floating">

                        <textarea class="form-control"  id="content" name="content" style="height: 120px">{{ $education? $education->content : '' }}</textarea>
                        <div class="invalid-feedback"></div>
                        <label for="content">Contents</label>
                    </div>
                </div>
            </div>


            <div style="text-align: end;">
                <button  class="btn btn-primary"  style="font-size: 12px;" id="btn-submit" name="btn-submit" >Simpan</button>
            </div>
@push('script')
    <script>

        $('#image').on('change', function() {
            const preview = $(this).parent();
            const file = this.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.css('background-image', `url('${e.target.result}')`);
            }

            reader.readAsDataURL(file);
        });

    </script>
@endpush
