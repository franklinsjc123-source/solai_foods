@extends('backend.app_template')
@section('title','Push Notification')
@section('content')
<main class="app-wrapper">
    <div class="container-fluid">
        <div class="d-flex align-items-center mt-2 mb-2">
            <div class="flex-shrink-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-end mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Marketing</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Push Notification</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <form method="POST" id="pushNotificationForm" action="{{ route('send-push-notification') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"> Push Notification </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-xl-6">
                                    <label for="message" class="form-label">
                                         Message <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control" id="message" name="message" placeholder="Enter Message" rows="1">{{ old('message') }}</textarea>
                                    @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-xl-6">
                                    <label for="notification_image" class="form-label">
                                         Image <span class="text-danger"></span>
                                    </label>
                                    <input type="file" class="form-control" id="notification_image" name="notification_image" accept="image/*" onchange="previewImage(this)">
                                    <div id="image_preview_container" class="mt-2 text-center" style="display:none;">
                                        <p class="small text-muted mb-1">Image Preview</p>
                                        <img id="notification_image_preview" src="#" alt="Notification Image" height="150" class="img-thumbnail">
                                    </div>
                                    @error('notification_image') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end gap-3">
                            <button type="submit" class="btn btn-primary">Send Notification</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#notification_image_preview').attr('src', e.target.result);
                $('#image_preview_container').show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function() {
        $("#pushNotificationForm").validate({
            rules: {
                message: {
                    required: true
                },
                // notification_image: {
                //     required: true
                // },
            },
            messages: {
                message: {
                    required: "Please enter message"
                },
                // notification_image: {
                //     required: "Please upload an image"
                // },
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.addClass("text-danger small");
                error.insertAfter(element);
            }
        });
    });
</script>
@endsection
