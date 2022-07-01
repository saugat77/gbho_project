@extends('layouts.app')

@section('content')
<<<<<<< HEAD
<div style="background-color: #f5f5f5;">
=======
<link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
    />

<div >
>>>>>>> 7f3aedc92570ca4d6173e4fd25fa4d3e1c0edc66
    <div class="block">
        <x-primary-image-slider />
    </div>

    <div class="my-5"></div>
<<<<<<< HEAD

    <div class="container py-">
        <section class="mb-4">
            <div class="flex items-center mb-4 sm:mb-6">
                <h2 class="tracking-wide text-lg">Top Products</h2>
                {{-- <h2 class="tracking-wide bg-main-40 bg-gradient-to-r from-main-500 rounded-sm via-blue-500 to-main-400 py-2 px-4 lg:px-8 text-white">Top Products</h2> --}}
                <a class="ml-auto text-sm text-red-600 font-semibold hover:underline" href="{{ route('frontend.products.by-group', 'top') }}">View All</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-6 gap-4">
                @foreach ($topProducts as $product)
                <x-product-card :product="$product" />
                @endforeach
            </div>
        </section>
    </div>
=======
    
   
>>>>>>> 7f3aedc92570ca4d6173e4fd25fa4d3e1c0edc66

    <div class="container py-5">
        <section class="mb-4">
            <div class="flex items-center mb-4 sm:mb-6">
<<<<<<< HEAD
                <h2 class="tracking-wide text-lg">New Arrivals</h2>
                <a class="ml-auto text-sm text-red-600 font-semibold hover:underline" href="{{ route('frontend.products.index') }}">View All</a>
            </div>
            <div class="bg-white  p-3 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-6 gap-4">
                @foreach ($latestProducts as $product)
                <x-product-card :product="$product" />
                @endforeach
=======
                <h2 class="tracking-wide text-lg"></h2>
                {{-- <h2 class="tracking-wide bg-main-40 bg-gradient-to-r from-main-500 rounded-sm via-blue-500 to-main-400 py-2 px-4 lg:px-8 text-white"></h2> --}}
                <a class="ml-auto text-sm text-red-600 font-semibold hover:underline" href="{{ route('frontend.products.by-group', 'top') }}"></a>
            </div>
            <div class="product-card grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3   gap-8">
                
                <section >
                <div class="container py-5">
                    <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card text-black">
                        
                        <img src=""
                            class="card-img-top" alt="Mission" />
                        <div class="card-body">
                            <div class="text-center">
                            <h5 class="card-title">Mission</h5>
                            <p class="text-muted mb-4">Lorem ipsum dolor sit amet.</p>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </section>
                
                <section>
                <div class="container py-5">
                    <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card text-black">
                        
                        <img src="" 
                            class="card-img-top" alt="vision" />
                        <div class="card-body">
                            <div class="text-center">
                            <h5 class="card-title">Vision</h5>
                            <p class="text-muted mb-4">Lorem ipsum dolor sit amet.</p>
                            </div>
                            <div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </section>

                <section>
                <div class="container py-5">
                    <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card text-black">
                        
                        <img src=""
                            class="card-img-top" alt="Core Value" />
                        <div class="card-body">
                            <div class="text-center">
                            <h5 class="card-title">Core Value</h5>
                            <p class="text-muted mb-4">Lorem ipsum dolor sit amet.</p>
                            </div>
                            <div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </section>
>>>>>>> 7f3aedc92570ca4d6173e4fd25fa4d3e1c0edc66
            </div>
        </section>
    </div>


<<<<<<< HEAD
=======


    <div class="container py-5">
        <section class="mb-4">
            <div class="flex items-center mb-4 sm:mb-6">
                <h2 class="tracking-wide text-lg"></h2>
                {{-- <h2 class="tracking-wide bg-main-40 bg-gradient-to-r from-main-500 rounded-sm via-blue-500 to-main-400 py-2 px-4 lg:px-8 text-white"> </h2> --}}
                <a class="ml-auto text-sm text-red-600 font-semibold hover:underline" href="{{ route('frontend.products.by-group', 'top') }}"></a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">
                
                <section>
                <div class="container py-5">
                    <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card text-black">
                        
                        <img src=""
                            class="card-img-top" alt="Current Event" />
                        <div class="card-body">
                            <div class="text-center">
                            <h5 class="card-title">Current Event</h5>
                            <p class="text-muted mb-4">Lorem ipsum dolor sit amet.</p>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </section>

                <section>
                <div class="container py-5">
                    <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card text-black">
                        
                        <img src="" 
                            class="card-img-top" alt="Upcoming event" />
                        <div class="card-body">
                            <div class="text-center">
                            <h5 class="card-title">Upcoming event</h5>
                            <p class="text-muted mb-4">Lorem ipsum dolor sit amet.</p>
                            </div>
                            <div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </section>

                <section>
                <div class="container py-5">
                    <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card text-black">
                        
                        <img src=""
                            class="card-img-top" alt="Blog Post" />
                        <div class="card-body">
                            <div class="text-center">
                            <h5 class="card-title">Blog Post</h5>
                            <p class="text-muted mb-4">Lorem ipsum dolor sit amet.</p>
                            </div>
                            <div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </section>
            </div>
        </section>
    </div>


    <div class="container py-5">
        <section class="mb-4">
            <div class="flex items-center mb-4 sm:mb-6">
                <h2 class="tracking-wide text-lg"></h2>
                {{-- <h2 class="tracking-wide bg-main-40 bg-gradient-to-r from-main-500 rounded-sm via-blue-500 to-main-400 py-2 px-4 lg:px-8 text-white"></h2> --}}
                <a class="ml-auto text-sm text-red-600 font-semibold hover:underline" href="{{ route('frontend.products.by-group', 'top') }}"></a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-10">
                
            
            <section>
                <div class="container py-5">
                    <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card text-black">
                        
                        <img src="" 
                            class="card-img-top" alt="News" />
                        <div class="card-body">
                            <div class="text-center">
                            <h5 class="card-title">News</h5>
                            <p class="text-muted mb-4">Lorem ipsum dolor sit amet.</p>
                            </div>
                            <div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </section>

                <section>
                <div class="container py-5">
                    <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card text-black">
                        
                        <img src=""
                            class="card-img-top" alt="Newsletter" />
                        <div class="card-body">
                            <div class="text-center">
                            <h5 class="card-title">Newsletter</h5>
                            <p class="text-muted mb-4">Lorem ipsum dolor sit amet.</p>

                            <button class="btn">
                                <a href="#">Submit</a>
                            </button> 
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </section>                
            </div>
        </div>
    </section>
</div>

<div class="container py-5">
        <section class="mb-4">
            <div class="flex items-center mb-4 sm:mb-6">
                <h2 class="tracking-wide text-lg"></h2>
                {{-- <h2 class="tracking-wide bg-main-40 bg-gradient-to-r from-main-500 rounded-sm via-blue-500 to-main-400 py-2 px-4 lg:px-8 text-white"></h2> --}}
                <a class="ml-auto text-sm text-red-600 font-semibold hover:underline" href="{{ route('frontend.products.by-group', 'top') }}"></a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                
            
            <section>
                <div class="container py-5">
                    <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card text-black">
                        
                        <img src="" 
                            class="card-img-top" alt="Advertisement " />
                        <div class="card-body">
                            <div class="text-center">
                            <h5 class="card-title">Advertisement </h5>
                            <p class="text-muted mb-4">Lorem ipsum dolor sit amet.</p>
                            </div>
                            <div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </section>


                    <section>
                        
                            <div class="row justify-content-center">
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                    <div class="card text-black">
                                        <div class="calendar">
                                        <iframe src="https://www.hamropatro.com/widgets/calender-medium.php" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" style="border:none; overflow:hidden; width:295px; height:385px;" allowtransparency="true"></iframe>
    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                    </section>                  
 </div>
</div>

<div class="container py-5">
        <section class="mb-4">
            <div class="flex items-center mb-4 sm:mb-6">
                <h2 class="tracking-wide text-lg"></h2>
                {{-- <h2 class="tracking-wide bg-main-40 bg-gradient-to-r from-main-500 rounded-sm via-blue-500 to-main-400 py-2 px-4 lg:px-8 text-white"></h2> --}}
                <a class="ml-auto text-sm text-red-600 font-semibold hover:underline" href="{{ route('frontend.products.by-group', 'top') }}"></a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                
            
            <section>
               
                    <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                       <div class="converter">
                        <h1>Date Converter</h1>
                       <iframe src="https://www.hamropatro.com/widgets/dateconverter.php" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" style="border:none; overflow:hidden; width:350px; height:150px;" allowtransparency="true"></iframe>
                       </div>
                    </div>
                    </div>
                
                </section>


                    <section>
                        <div class=" py-5">
                            <div class="row justify-content-center">
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                    <div class="card text-black">
                                    <div class="clock" id="nepal">
                                        
                                    </div>
                                    <div class="place">
                                            <h1>Nepal</h1>
                                        </div>

                                        <div class="clock" id="us">
                                        
                                    </div>
                                    <div class="place">
                                            <h1>Us</h1>
                                        </div>
                                            
                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>                  
        </div>
</div>

</section>
</div>
  <script>
    setInterval(function(){
  var date = new Date();
  var format = [
      ("0" + date.getHours()).substr(-2)
    , ("0" + date.getMinutes()).substr(-2)
    , ("0" + date.getSeconds()).substr(-2)
  ].join(":");
  document.getElementById("nepal").innerHTML = format;
}, 500)

setInterval(function(){
  var date = new Date();
  var format = [
      ("0" + date.getHours()).substr(-2)
    , ("0" + date.getMinutes()).substr(-2)
    , ("0" + date.getSeconds()).substr(-2)
  ].join(":");
  document.getElementById("us").innerHTML = format;
}, 500)
  </script>

>>>>>>> 7f3aedc92570ca4d6173e4fd25fa4d3e1c0edc66
    <div class="bg-gray-100">
        <div class="container py-5 md:py-8 ">
            <div class="text-center mb-4 sm:mb-6">
                <h2 class="text-lg sm:text-2xl tracking-wide">Blogs</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 lg:gap-8">
                @foreach ($posts as $post)
                <div class="bg-white rounded shadow-sm overflow-hidden">
                    @if ($post->cover_image)
                    <a href="{{ route('frontend.blogs.show', $post) }}" class="block aspect-w-12 aspect-h-6">
                        <img src="{{ $post->imageUrl() }}" alt=" {{ $post->title }}">
                    </a>
                    @endif
                    <div class="p-4">
                        <h6 class="text-gray-800 line-clamp-1">
                            <a href="{{ route('frontend.blogs.show', $post) }}">
                                {{ $post->title }}
                            </a>
                        </h6>
                        <p class="text-sm">
                            {{ $post->excerpt }}
                        </p>
                        <a href="{{ route('frontend.blogs.show', $post) }}" class="underline text-sm font-semibold mt-4">Read More</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5 sm:mt-6">
                <a href="{{ route('frontend.blogs.index') }}" class="inline-block py-2 px-4 bg-blue-600 text-white rounded-full hover:bg-blue-500 font-semibold text-sm">View All Blogs</a>
            </div>
        </div>
    </div>

    <div class="text-white py-5" style="background-color: #444444;">
        @include('frontend.partials.our-services')
    </div>

</div>
<<<<<<< HEAD
=======

<script src="script.js"></script>
    <script>
        const date = new Date();

const renderCalendar = () => {
  date.setDate(1);

  const monthDays = document.querySelector(".days");

  const lastDay = new Date(
    date.getFullYear(),
    date.getMonth() + 1,
    0
  ).getDate();

  const prevLastDay = new Date(
    date.getFullYear(),
    date.getMonth(),
    0
  ).getDate();

  const firstDayIndex = date.getDay();

  const lastDayIndex = new Date(
    date.getFullYear(),
    date.getMonth() + 1,
    0
  ).getDay();

  const nextDays = 7 - lastDayIndex - 1;

  const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];

  document.querySelector(".date h1").innerHTML = months[date.getMonth()];

  document.querySelector(".date p").innerHTML = new Date().toDateString();

  let days = "";

  for (let x = firstDayIndex; x > 0; x--) {
    days += `<div class="prev-date">${prevLastDay - x + 1}</div>`;
  }

  for (let i = 1; i <= lastDay; i++) {
    if (
      i === new Date().getDate() &&
      date.getMonth() === new Date().getMonth()
    ) {
      days += `<div class="today">${i}</div>`;
    } else {
      days += `<div>${i}</div>`;
    }
  }

  for (let j = 1; j <= nextDays; j++) {
    days += `<div class="next-date">${j}</div>`;
    monthDays.innerHTML = days;
  }
};

document.querySelector(".prev").addEventListener("click", () => {
  date.setMonth(date.getMonth() - 1);
  renderCalendar();
});

document.querySelector(".next").addEventListener("click", () => {
  date.setMonth(date.getMonth() + 1);
  renderCalendar();
});

renderCalendar();
    </script>
>>>>>>> 7f3aedc92570ca4d6173e4fd25fa4d3e1c0edc66
@endsection
