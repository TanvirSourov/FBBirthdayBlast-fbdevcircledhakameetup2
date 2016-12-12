<!DOCTYPE html>
<html>
    <head>
        <title>Facebook Dev Circle Dhaka Meetup 2</title>
    </head>
    <body>
        <div>
            <ul>
                @foreach($ids as $id)
                    <li>{{ $id }}</li>
                @endforeach
            </ul>

            <br>

            <ul>
                @foreach($messages as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>

        <form action = "{{ route('postmessage') }}" method="post" >
            <center>
            <div>
                <div class="col-md-5 col-sm-5 col-lg-5">
                    <div class="input-group fg-float">
                        <span class="input-group-addon"><i class="zmdi zmdi-search"></i></span>
                        <div class="fg-line">
                            <input type="text" required name="message_post" class="form-control">
                            <label class="fg-label">Type Message...</label>
                        </div>
                    </div>
                </div>


                <button type="submit" style="margin-top:4px;" class="col-md-1 col-sm-1 col-lg-1 btn btn-default btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-check"></i>Submit</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </div>
            </center>
        </form>
    </body>
</html>
