@extends('templates.default')

@section('content')
<body style="background:#c2d4d8;">
       <header class="header ">
        <div class="container">
          <div class="row ">
           <h4 class="page-header">
             <p class="text-center">You can find solutions via notes. You can <a href="{{route('templates.studymaterials.inventory')}}">visit inventory</a> or just search by typing what you want and hit enter. Simple, isn't it?
            </p>
          </h4>

            <div class="col-lg-6 col-lg-offset-3">
               <form action="{{route('templates.studymaterials.results')}}" role="form" method="GET">
                   <div class="input-group">
                     <input type="text" name="query" class="form-control" placeholder="Search notes by faculty or subject.">
                        <span class="input-group-btn">
                         <button class="btn btn-info btn-circle" type="submit">Search</button>
                        </span>      
                    
                    </div>
              </form>                              
            </div>

            <div class="row mt-100">
           		
  	            <h4>
  	            	<p class="text-center">Your help is much appreciated.</p><br/>
  	            </h4>
  	         	 <div class="col-md-3 col-md-offset-5">
  	            	   <a href="{{route('templates.studymaterials.upload')}}"><button class="btn btn-success btn-circle">Click here to upload</button></a>
  	           </div> 	 
            </div>



        </div>



      </div>

    </header>
 </body>
@stop