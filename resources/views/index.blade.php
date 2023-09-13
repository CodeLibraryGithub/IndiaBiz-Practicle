<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>User Profile</title>
      <link href="{{ asset('css/jquerysctipttop.css') }}" rel="stylesheet">
      <link href="{{ asset('css/bootswatch/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('css/tagsinput.css') }}" rel="stylesheet">
      <link href="{{ asset('css/style.css') }}" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   </head>
   <body>
      <?php 
         $activities = ['Buy','Invest','Partner','Lease','Franchise'];
         $locations = ['Rajkot','Ahemedabad','Surat'];
         $industries = ['Hotel','Restaurant','Finance','Medical','Software'];
         $funding_source = ['Own','Family & friends','Bank Loan','External investors'];
         ?>
      <div class="container rounded bg-white mt-5 mb-5">
         <form id="userdetails" action="{{route('saveuserdetails')}}" method="post" enctype="multipart/form-data">
            @csrf  
            <input type="hidden" id="EditId" name="id" value="{{isset($user->id) ? $user->id : ''}}">
            <div class="row">
               <div class="col-md-4">
                  @if(Session::has('success'))
                  <div class="alert alert-success">
                     {{Session::get('success')}}
                  </div>
                  @endif
               </div>
            </div>
            <div class="row">
               <div class="col-md-2">
                  <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                     <div class="avatar-upload">
                        <div class="avatar-edit">
                           <input type='file' name="profile_picture" id="imageUpload" accept=".png, .jpg, .jpeg" />
                           <label for="imageUpload"></label>
                        </div>
                        <div><label for="imageUpload" class="error"></label></div>
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
                     <span class="font-weight-bold">
                     {{isset($user->name) ? $user->name : ''}}
                     </span>
                  </div>
               </div>
               <div class="col-md-5">
                  <div class="p-3 py-5">
                     <div class="row mt-3">
                        <div class="d-flex justify-content-between align-items-center experience">
                           <h5>Bussiness Interests</h5>
                        </div>
                        <div class="col-md-12">
                           <label class="labels"><strong>Activities</strong><span class="red-star">*</span></label>
                           <br>
                           @foreach($activities as $key => $value)
                           <?php 
                              $checkbox = '';
                              if(isset($user->activities)){
                                 $activitiesArr = json_decode($user->activities);
                                 
                                 if(in_array($value,$activitiesArr)){
                                    $checkbox = 'checked';
                                 }
                              }
                              ?>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="checkbox" name="activities[]" id="inlineCheckbox-{{$key}}" value="{{$value}}" {{$checkbox}}>
                              <label class="form-check-label" for="inlineCheckbox-{{$key}}">{{$value}}</label>
                           </div>
                           @endforeach
                           <div><label for="activities[]" class="error"></label></div>
                        </div>
                        <div class="col-md-12">
                           <label class="labels"><strong>Industries</strong><span class="red-star">*</span></label>
                           <select class="form-select" name="industries" aria-label="Default select example">
                              <option value="">Select</option>
                              @foreach($industries as $key => $value)
                              <?php 
                                 $selected = "";
                                 if(isset($user->industries) &&  $value ==$user->industries){
                                       $selected = "selected";
                                 } ?>
                              <option value="{{$value}}" {{$selected}}>{{$value}}</option>  
                              @endforeach  
                           </select>
                        </div>
                        <div class="col-md-12">
                           <label class="labels"><strong>Location</strong><span class="red-star">*</span></label>
                           <select class="form-select" name="locations[]" aria-label="Default select example" multiple>
                              <option value="">Select</option>
                              @foreach($locations as $key => $value)
                              <?php
                                 $selected = ''; 
                                 if(isset($user->locations)){
                                    $locationsArr = json_decode($user->locations);
                                    if(in_array($value,$locationsArr)){
                                       $selected = 'selected';
                                    }
                                 }
                                 ?>
                              <option value="{{$value}}" {{$selected}}>{{$value}}</option>  
                              @endforeach 
                           </select>
                        </div>
                     </div>
                     <br>
                     <div class="row mt-3">
                        <div class="d-flex justify-content-between align-items-center experience">
                           <h5>Financial</h5>
                        </div>
                        <div class="col-md-12">
                           <label class="labels"><strong>Funding source</strong><span class="red-star">*</span></label>
                           <br>
                           @foreach($funding_source as $key => $value)
                           <?php
                              $checked = ''; 
                              if(isset($user->funding_source) && $user->funding_source == $value){
                                 $checked = 'checked';
                              }
                              ?>
                           <div class="form-check">
                              <input class="form-check-input" value="{{$value}}" type="radio" name="funding_source" id="fs-{{$key}}" {{$checked}} >
                              <label class="form-check-label" for="fs-{{$key}}">{{$value}}</label>
                           </div>
                           @endforeach
                           <div><label for="funding_source" class="error"></label></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-5">
                  <div class="p-3 py-5">
                     <div class="d-flex justify-content-between align-items-center experience">
                        <h5>Personal</h5>
                     </div>
                     <div class="col-md-12"><label class="labels"><strong>Name</strong><span class="red-star">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{isset($user->name) ? $user->name : ''}}">
                     </div>
                     <div class="col-md-12"><label class="labels"><strong>Mobile</strong><span class="red-star">*</span></label>
                        <input type="text" name="mobile_no" class="form-control numbersOnly" placeholder="Enter mobile" value="{{isset($user->mobile_no) ? $user->mobile_no : ''}}" maxlength="10">
                     </div>
                     <div class="col-md-12"><label class="labels"><strong>ZipCode</strong><span class="red-star">*</span></label>
                        <input type="text" name="zip_code" class="form-control numbersOnly" placeholder="Enter zipcode" value="{{isset($user->zip_code) ? $user->zip_code : ''}}" maxlength="6">
                     </div>
                  </div>
                  <div class="p-3 py-5">
                     <div class="d-flex justify-content-between align-items-center experience">
                        <h5>Professional</h5>
                     </div>
                     <div class="col-md-12"><label class="labels"><strong>Company Name</strong></label>
                        <input type="text" name="company_name" class="form-control" placeholder="Enter company name" value="{{isset($user->company_name) ? $user->company_name : ''}}">
                     </div>
                     <div class="col-md-12"><label class="labels"><strong>Skills</strong><span class="red-star">*</span></label>
                        <?php 
                           if(isset($user->skills)){
                              $skills = $user->skills;
                           }else{
                              $skills = 'Marketing,Electronics,Culinary';
                           }
                           ?>
                        <input type="text" name="skills" data-role="tagsinput" value="{{$skills}}" required>
                     </div>
                     <br>
                     <div class="col-md-12">
                        @if(isset($user->id))
                        <button class="btn btn-primary profile-button" type="submit">Update</button>
                        <button id="Preview" class="btn btn-primary profile-button" type="button">Preview</button>
                        <button id="DeleteProfile" class="btn btn-danger delete-button" type="button">Delete</button>
                        @else
                        <button class="btn btn-primary profile-button" type="submit">Add</button>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
      <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('js/jquery.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/typeahead.bundle.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/tagsinput.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
      <script>
         $('form[id="userdetails"]').validate({
            rules: {
               profile_picture: {
                  required: true,
                  extension: "jpg|jpeg|png|gif"
               },
               'activities[]':'required',
               industries: 'required',
               'locations[]': 'required',
               funding_source: 'required',
               name:'required',
               mobile_no: {
                  required: true,
                  minlength: 10,
                  maxlength:10
               },
               zip_code: {
                  required: true,
                  minlength: 6,
                  maxlength:6
               }
            },
            messages: {
               profile_picture: {
                  required: "Please upload profile picture.",
                  extension: "Please upload profile picture in these format only (jpg, jpeg, png, gif)."
               },
               'activities[]': 'This field is required.',
               industries: 'Please select industries.',
               'locations[]': 'Please select locations.',
               funding_source: 'Please select funding source.',
               name:"Please enter the name.",
               mobile_no: {
                  required: 'Please enter mobile no.',
                  minlength: 'Mobile no must be at least 10 digit number.'
               },
               zip_code: {
                  required: 'Please enter zipcode.',
                  minlength: 'Zipcode must be 6 digit number.'
               }
            },
            submitHandler: function(form) {
               form.submit();
            }
         });
         /* For Image Preview */
         function readURL(input) {
            if (input.files && input.files[0]) {
               var reader = new FileReader();
               reader.onload = function(e) {
                     $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                     $('#imagePreview').hide();
                     $('#imagePreview').fadeIn(650);
               }
               reader.readAsDataURL(input.files[0]);
            }
         }
         $("#imageUpload").change(function() {
            readURL(this);
         });
         $('#Preview').click(function(){
            location.href = "{{url('/view')}}";
         });
         $('#DeleteProfile').click(function(){
            if (confirm("Are you sure you want to delete this profile?")) {
               location.href = "{{url('/deleteprofille')}}/"+$('#EditId').val();
            }
         });
         $('.numbersOnly').keyup(function () { 
            this.value = this.value.replace(/[^0-9\.]/g,'');
         });
         
         $('#imageUpload').on('change', function() {
              var size =(this.files[0].size);
              if(size > 2000000) {
                  $(this).val('');
                  alert('Profile picture must be less then 2 MB.');
              };
               /* current this object refer to input element */
               var $input = $(this);
                  
               /* collect list of files choosen */
               var files = $input[0].files;
         
               for(var i=0;i<files.length;i++){
                  var filename = files[i].name;
         
                  /* getting file extenstion eg- .jpg,.png, etc */
                  var extension = filename.substr(filename.lastIndexOf("."));
         
                  /* define allowed file types */
                  var allowedExtensionsRegx = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
         
                  /* testing extension with regular expression */
                  var isAllowed = allowedExtensionsRegx.test(extension);
         
                  if(isAllowed){
                  }else{
                     alert("Profile picture allowed only jpg, jpeg, png, gif file.");
                  }
               }           
          });
      </script>
   </body>
</html>