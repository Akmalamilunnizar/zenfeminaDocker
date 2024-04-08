@php
    $education = $educations ?? null;
@endphp

@csrf
            <div class="row mb-3" style="margin-left: 10px; margin-top: 15px">
                <div class="col-sm-4">
                    <div  class="upload-container" style="text-align: center; display: flex; justify-content: center; align-items: center;">
                            @if($education)
                                <div class="upload-button-edit" onclick="document.getElementById('image').click()" >
                                    <img src="/assets/educations/{{$education?->image}}"  id="previewImg" style="max-width: 100%; max-height: 100%; height: auto;">
                                    <input type="hidden" id="inputImg" name="inputImg" >
                                    <input type="file" class="@error('image') is-invalid @enderror" id="image" name="image" accept="image/jpeg" style="display:none" onchange="handleFileEdit(this)" >
                                </div>
                            @else
                                <div class="upload-button" onclick="document.getElementById('image').click()">
                                    <div class="mb-10">
                                        <i class="bi bi-cloud-upload" style="font-size: 48px;"></i>
                                        <h5 style="margin-top: 10px;">Unggah Foto</h5>
                                    </div>
                                    <input class=" @error('image') is-invalid @enderror" type="file" id="image" name="image" accept="image/jpeg" style="display:none" onchange="handleFileUpload(this)"/>
                                </div>
                            @endif
                    </div>
                    @error('image')
                    <div class="invaid-feedback" style="text-align: center; margin-top: 70px">
                        <small class="text-danger">{{ $message }}</small>
                    </div>
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
                        <textarea class="form-control  @error('contents') is-invalid @enderror"  id="contents" name="contents" style="height: 120px">{{ $education? $education->content : '' }}</textarea>
                        <label for="contents">Contents</label>
                        @error('contents')
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


        let currentImage = null;
        function handleFileUpload(input) {
            const file = input.files[0];
            const uploadButton = document.querySelector('.upload-button');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (currentImage) {
                        currentImage.parentNode.removeChild(currentImage);
                    }
                    const newImage = document.createElement('img');
                    newImage.setAttribute('id', 'previewImage');
                    newImage.setAttribute('src', e.target.result);
                    newImage.setAttribute('style', 'max-width: 100%; max-height: 100%; margin-top: 10px;');
                    input.parentNode.appendChild(newImage);
                    currentImage = newImage;
                    uploadButton.style.backgroundColor = '#fff';
                    uploadButton.style.border = '0px';
                    uploadButton.querySelector('h5').style.display = 'none';
                    uploadButton.querySelector('i').style.display ='none';
                };
                reader.readAsDataURL(file);
            }
        }

        //handle edit
        //img on edit article
        let currentImage2 = document.getElementById('previewImg'); // Mengambil elemen gambar saat ini
        function handleFileEdit(input) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Setel atribut src elemen gambar sesuai dengan file yang dipilih
                    currentImage2.setAttribute('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        }

    </script>
@endpush
