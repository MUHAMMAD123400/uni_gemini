<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="card">
                    <h5 class="card-header">Featured</h5>
                    <div class="card-body">
                        <form id="sendPrompt">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="text" class="form-control" id="prompt" name="prompt" />
                            </div>
                            <button type="submit" class="btn btn-primary submit_button">Submit</button>
                            <div class="spinner-border d-none" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-5 d-none" id="result_main">
                <div class="card">
                    <div class="card-body" id="result_show">

                    </div>
                    <button id="speak">speak</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('#sendPrompt').on('submit', function(e) {
                e.preventDefault();
                let data = $(this).serialize();
                let url = "{{ route('send-prompt') }}";
                console.log(data);
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'data': data
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $('.spinner-border').removeClass('d-none');
                        $('.submit_button').attr('disabled', true);
                    },
                    complete: function() {
                        $('.spinner-border').addClass('d-none');
                        $('.submit_button').attr('disabled', false);
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $('#result_show').append(response.data);
                            $('#result_main').removeClass('d-none');
                        }
                    }
                });
            });

            $('#speak').on('click', function(e) {
                e.preventDefault();
                let text = $('#result_show').text();
                let utterance = new SpeechSynthesisUtterance(text);
                // utterance.lang = "tr";
                speechSynthesis.speak(utterance);
            })
        });
    </script>
</body>

</html>
