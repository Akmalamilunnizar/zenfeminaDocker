@php
    $education = isset($education) ? $education : null;
@endphp

@csrf
            <div class="row mb-3" style="margin-left: 10px; margin-top: 15px">
                <div class="col-sm-4" style="margin-top: 15px">
                    <label class="image-preview" for="image" style="background-image: url('{{ Storage::url($education?->image) }}')">
                        <small>Klik untuk {{ $education ? 'mengganti' : 'mengunggah' }} foto</small>
                        <input type="file" name="image" id="image" class="d-none " accept="image/*">
                    </label>

                    @error('image')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-sm-8" style="margin-top: 10px">
                    <div class="mb-3" style="font-size: 14px;">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $education?->title) }}" name="title">
                        @error('title')
                        <div class="invaid-feedback">
                            <small class="text-danger">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3" style="font-size: 14px; display: flex; flex-direction: column;">
                        <label for="category_id" class="form-label" style="margin-bottom: 5px;">Katagori</label>
                        <div style="display: flex;">
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" aria-label="Pilih Kategori" id="category_id" style="width: 100%; margin-right: 10px;">
                                <option>-- Pilih --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if($category->id == $education?->category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        @error('category_id')
                        <div class="invaid-feedback">
                            <small class="text-danger">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control  @error('content') is-invalid @enderror"  id="content" name="content" style="height: 120px">{{ $education? $education->content : '' }}</textarea>
                        <label for="content">Contents</label>
                        @error('content')
                        <div class="invaid-feedback">
                            <small class="text-danger">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>
                </div>
            </div>


            <div style="text-align: end;">
                <button type="submit" class="btn btn-primary"  style="font-size: 12px;" id="btn-submit" name="btn-submit" >Simpan</button>
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
