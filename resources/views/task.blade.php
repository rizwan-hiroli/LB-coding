<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LabelBlind</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.buttons.css" rel="stylesheet">
    </head>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="pr-4" href="https://www.labelblind.com">
      <img src="https://www.labelblind.com/assets/img/logo-white-sm.png" width="120px">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Blogs</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Trending</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">New Product</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Get In Touch</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <body>

        <div class="loader" id="loader"></div>
        <div class="content pt-5 justify-content-center d-flex" id="photos">
            <div class="card col-md-8 justify-content-center" style="border:0px">
            <div class="card-header">
                <div class="row">
                <h3 class="col-md-10">Currency Converter</h3> 
                <a class="btn btn-dark pull-right" style="color: white" data-toggle="modal" data-target="#convertModal">
                  <i class="fa fa-download icon"></i>  Import 
                </a>
                </div>
            </div>
            <div class="card-body">
              <h5 class="card-title">Enter Amount in rupees</h5>
              <p class="card-text">Amount in Rupees to see equivalent Dollar</p>
              
              @csrf
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Rupees (₹)</span>
                </div>
                <input type="number" id="rupeesAmount" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" required>
                <div class="pl-3">
                    <button type="submit" id="convertButton" class="btn btn-dark pl-2"><i class="fa fa-refresh icon" data-loading-text="<i class='fa fa-circle-o-notch fa-spin '></i> Loading..."></i> Convert</button>
                </div>
              </div>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">USD ($)</span>
                </div>
                <input type="text" id="usdAmount" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" disabled>
              </div><br><br>

              <div id="full-content" style="display: none">

                  <div class="input-group" style="-ms-flex-align:stretch; -ms-flex-wrap:wrap; align-items:stretch; display:flex; flex-wrap:wrap; position:relative; width:100%;" width="100%">
                    <div class="input-group-prepend" style="display:flex; margin-right:-1px">
                      <span class="input-group-text" style="-ms-flex-align:center; align-items:center; background-color:#e9ecef; border:1px solid #ced4da; border-radius:0.25rem; color:#495057; display:flex; font-size:1rem; font-weight:400; line-height:1.5; margin-bottom:0; padding:0.375rem 0.75rem; text-align:center; white-space:nowrap; border-bottom-right-radius:0; border-top-right-radius:0" bgcolor="#e9ecef" align="center">Average - <span id="avg"></span></span>
                    </div>
                    <div class="pl-2">
                      <span class="input-group-text" style="-ms-flex-align:center; align-items:center; background-color:#e9ecef; border:1px solid #ced4da; border-radius:0.25rem; color:#495057; display:flex; font-size:1rem; font-weight:400; line-height:1.5; margin-bottom:0; padding:0.375rem 0.75rem; text-align:center; white-space:nowrap" bgcolor="#e9ecef" align="center">Maximum - <span id="max"></span></span>
                    </div>
                    <div class="pl-2">
                      <span class="input-group-text" style="-ms-flex-align:center; align-items:center; background-color:#e9ecef; border:1px solid #ced4da; border-radius:0.25rem; color:#495057; display:flex; font-size:1rem; font-weight:400; line-height:1.5; margin-bottom:0; padding:0.375rem 0.75rem; text-align:center; white-space:nowrap" bgcolor="#e9ecef" align="center">Minimum - <span id="min"></span></span>
                    </div>
                    <div class="pl-2">
                      <span class="input-group-text" style="-ms-flex-align:center; align-items:center; background-color:#e9ecef; border:1px solid #ced4da; border-radius:0.25rem; color:#495057; display:flex; font-size:1rem; font-weight:400; line-height:1.5; margin-bottom:0; padding:0.375rem 0.75rem; text-align:center; white-space:nowrap" bgcolor="#e9ecef" align="center">Rate - <span id="rate"></span></span>
                    </div>
                    <div class="pl-2">
                      <span class="input-group-text" style="-ms-flex-align:center; align-items:center; background-color:#e9ecef; border:1px solid #ced4da; border-radius:0.25rem; color:#495057; display:flex; font-size:1rem; font-weight:400; line-height:1.5; margin-bottom:0; padding:0.375rem 0.75rem; text-align:center; white-space:nowrap" bgcolor="#e9ecef" align="center">Time - <span id="time"></span></span>
                    </div>
                    

                    <div class="pl-2 pull-right">
                        <button type="submit" id="emailButton" class="btn btn-dark" style="-webkit-appearance:button; border-radius:0.25rem; font-family:inherit; font-size:1rem; line-height:1.5; margin:0; overflow:visible; text-transform:none; -moz-user-select:none; -ms-user-select:none; -webkit-user-select:none; background-color:#343a40; border:1px solid transparent; color:#fff; cursor:pointer; display:inline-block; font-weight:400; padding:0.375rem 0.75rem; text-align:center; transition:color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; user-select:none; vertical-align:middle; border-color:#343a40" bgcolor="#343a40" align="center" valign="middle"><i class="fa fa-envelope-square icon"></i> Email</button>
                    </div>
                    
                  </div><br>


                  

                  <table class="table table-hover table-dark pt-5" style="border-collapse:collapse; color:#fff; margin-bottom:1rem; width:100%; background-color:#343a40; padding-top:3rem" width="100%" bgcolor="#343a40">
                    <thead >
                      <tr>
                        <th scope="col" style="text-align:inherit; border-top:1px solid #dee2e6; padding:0.75rem; vertical-align:bottom; border-color:#454d55; border-bottom:2px solid #dee2e6" align="inherit" valign="bottom">#</th>
                        <th scope="col" style="text-align:inherit; border-top:1px solid #dee2e6; padding:0.75rem; vertical-align:bottom; border-color:#454d55; border-bottom:2px solid #dee2e6" align="inherit" valign="bottom">Rupee(s)</th>
                        <th scope="col" style="text-align:inherit; border-top:1px solid #dee2e6; padding:0.75rem; vertical-align:bottom; border-color:#454d55; border-bottom:2px solid #dee2e6" align="inherit" valign="bottom">Rate(usd)</th>
                        <th scope="col" style="text-align:inherit; border-top:1px solid #dee2e6; padding:0.75rem; vertical-align:bottom; border-color:#454d55; border-bottom:2px solid #dee2e6" align="inherit" valign="bottom">Result(usd)</th>
                      </tr>
                    </thead>
                    <tbody id="table-data" >

                    </tbody>
                  </table>

              </div>

            </div>
        </div>
        </div>

        <!-- modal to import currency -->
        <div class="modal fade subscriptionModal" id="convertModal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header d-block">
                  <button type="button" class="close closemodal pull-right" data-dismiss="modal"><span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel"> Convert Currency</h4>
                </div>
                <div class="modal-body">
                  {{ Form::open(['url' => 'admin/result/import','method_type' => 'POST','id' => 'resultImportForm','name' => 'resultImportForm'])}}
                  <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                  
                <input type="hidden" name="routeName" id="routeName" value="/admin/result/import">
                  
                  <div class="item form-group mt30">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Select File
                      <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12 padding-left-0">
                      <input type="file" accept=".csv" name="file" id='file' />
                    </div>
                    {{-- <p>Allowed Extensions: .csv</p> --}}
                    <div class="row">
                      <div class="col-md-8 col-md-offset-3">
                        <div class="id-file-error-div title commonError error_flash hide"></div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="item form-group mt30">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                    </label>
                    <div class="col-md-12 col-sm-12 col-xs-12 padding-left-0">
                      <p id="importLink"></p>
                    </div>
                  </div>
                  
                  {{ Form::close() }}
                </div>
                <div class="modal-footer">
                    
                    <a href="{{asset('templates/template.csv')}}">
                      <input type = "button" class="btn btn-dark" name="Download Sample Sheet" value="Download Template" style="position: absolute;left:0;margin-left: 10px;margin-top:-20px">
                    </a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id='upload' type="submit" name="upload" class="btn btn-dark" data-loading-text="<i class='fa fa-circle-o-notch fa-spin '></i> Loading...">Upload</button>
                    
                </div>
                
                </div>
            </div>
          </div>

        
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.buttons.js"></script>
    <script src="js/converter.js"></script>
    
</html>
