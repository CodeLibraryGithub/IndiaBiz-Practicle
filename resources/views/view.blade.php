<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>View Profile</title>
      <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
      <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('js/jquery.min.js') }}"></script>
      <link href="{{ asset('css/style.css') }}" rel="stylesheet">
   </head>
   <body>
      <div class="container rounded bg-white mt-5 mb-5">
         @if(Session::has('success'))
         <div class="alert alert-success">
            {{Session::get('success')}}
         </div>
         @endif
         <div class="row">
            <div class="col-md-2">
               <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                  <div class="avatar-upload">
                     <div class="avatar-preview">
                        @if(isset($user->profile_picture))
                        <?php 
                           $image = url('images').'/'.$user->profile_picture;
                           ?>
                        <div id="imagePreview" style="background-image: url({{$image}});"></div>
                        @else
                        <?php $noimage = url('images').'/no-image.png'; ?>
                        <div id="imagePreview" style="background-image: url({{$noimage}});"></div>
                        @endif
                     </div>
                  </div>
                  <span class="font-weight-bold">{{isset($user->name) ? $user->name : ''}}</span>
               </div>
            </div>
            <div class="col-md-5">
               <div class="p-3 py-5">
                  <div class="row mt-3">
                     <div class="d-flex justify-content-between align-items-center experience">
                        <h5>Bussiness Interests</h5>
                     </div>
                     <div class="col-md-12">
                        <label class="labels"><strong>Activities : </strong></label>
                        <p><?php
                           $activitiesArr = json_decode($user->activities);
                           echo implode(",",$activitiesArr); 
                           ?></p>
                     </div>
                     <div class="col-md-12">
                        <label class="labels"><strong>Industries : </strong></label>
                        <p><?php echo $user->industries; ?></p>
                     </div>
                     <div class="col-md-12">
                        <label class="labels"><strong>Locations : </strong></label>
                        <p><?php
                           $locationsArr = json_decode($user->locations);
                           echo implode(",",$locationsArr);
                           ?>
                        </p>
                     </div>
                  </div>
                  <br><br>
                  <div class="row mt-3">
                     <div class="d-flex justify-content-between align-items-center experience">
                        <h5>Financial</h5>
                     </div>
                     <div class="col-md-12">
                        <label class="labels"><strong>Funding Source : </strong></label>
                        <p>{{$user->funding_source}}</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-5">
               <div class="p-3 py-5">
                  <div class="d-flex justify-content-between align-items-center experience">
                     <h5>Personal</h5>
                  </div>
                  <div class="col-md-12">
                     <label class="labels"><strong>Name</strong></label>
                     <p>{{isset($user->name) ? $user->name : ''}}</p>
                  </div>
                  <div class="col-md-12">
                     <label class="labels"><strong>Mobile</strong></label>
                     <p>{{isset($user->mobile_no) ? $user->mobile_no : ''}}</p>
                  </div>
                  <div class="col-md-12">
                     <label class="labels"><strong>ZipCode : </strong></label>
                     <p>{{isset($user->zip_code) ? $user->zip_code : ''}}</p>
                  </div>
               </div>
               <div class="p-3 py-5">
                  <div class="d-flex justify-content-between align-items-center experience">
                     <h5>Professional</h5>
                  </div>
                  <div class="col-md-12">
                     <label class="labels"><strong>Company Name : </strong></label>
                     <p>{{isset($user->company_name) ? $user->company_name : '-'}}</p>
                  </div>
                  <div class="col-md-12">
                     <label class="labels"><strong>Skills : </strong></label>
                     <p>
                        <?php 
                           if(isset($user->skills)){
                              echo $user->skills;
                           }else{
                              echo 'Marketing, Electronics, Culinary';
                           }
                           ?>
                     </p>
                  </div>
                  <div class="col-md-12">
                     <button id="BackButton" class="btn btn-primary profile-button" type="button">Back</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script>
         $('#BackButton').click(function() {
            location.href = "{{url('/')}}";
         });
      </script>
   </body>
</html>