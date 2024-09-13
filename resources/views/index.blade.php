<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mega News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="index/css/index.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-danger" href="#">MEGA.news</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-bold text-dark" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Category
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-bold text-dark" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Pages
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold text-dark" aria-current="page" href="#">Contact
                            Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="#">About Us</a>
                    </li>
                </ul>
                <form>
                    <i class="fa-solid fa-ellipsis-vertical cursor-pointer"></i>

                    <input class="me-2 search" type="text" placeholder="Search Anything" aria-label="Search">
                    <i class="fa-solid fa-magnifying-glass fw-bold"></i>
                </form>
            </div>
        </div>
    </nav>

    <div class="container" style="padding-top: 70px;">
        <div class="category-slider">
            @foreach ($category as $data)
                <div class="category-item">
                    <img src="{{ $data->thumbnail_image }}" alt="" class="category-img">
                    <div class="img-txt">
                        <p>#{{ $data->category_name }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="car-music">
            <div class="car">
                <div class="car1">
                    <img src="index/images/car-girl/car.jpg" alt="Car image" class="car-img">
                    <div class="car-img-txt">
                        <h6>How to Drive a Car Safely</h6>
                        <p>Ah, The Joy Of the Open Road - it's a good feeling. But if you're new to driving, you may...
                        </p>
                    </div>
                </div>
                <div class="girl1">
                    <img src="index/images/car-girl/girl.jpg" alt="Girl image" class="girl-img">
                    <div class="car-img-txt">
                        <h6>How to Drive a Car Safely</h6>
                        <p>Ah, The Joy Of the Open Road - it's a good feeling. But if you're new to driving, you may...
                        </p>
                    </div>
                </div>
            </div>
            <div class="tech">
                <img src="index/images/category/06.jpg" alt="Tech image" class="tech-img">
                <div class="car-img-txt">
                    <h6>Why I Stopped Using Multiple Monitors</h6>
                    <p>A single monitor manifesto - many developers believe multiple monitors boost productivity.
                        Studies have proven it, right? Well, keep in mind, many of...</p>
                </div>
            </div>
        </div>

        <div class="popular-post mt-5 mb-5">
            <div class="d-flex mb-3 position-relative">
                <div class="post w-50 text-start">
                    <p class="mb-0 fw-bold fs-5">Popular Post</p>
                </div>
                <div class="arrow w-50 text-end position-relative">
                    <i class="fa-solid fa-chevron-left slick-prev"></i>
                    <i class="fa-solid fa-chevron-right slick-next"></i>
                </div>
            </div>

            <div class="slick-slider">
                @foreach ($post as $PostData)
                    @if ($PostData->post_type == 'Popular Post')
                        <div class="card">
                            <img src="{{ asset($PostData->thumbnail_image) }}" class="post-image"
                                alt="Opening Day Of Boating Season, Seattle Wa">
                            <div class="card-body">
                                <div class="rotate-icon mb-1">
                                    <i class="fa-solid fa-tag fs-4 rotate"></i>
                                    <p class="mb-0 fw-bold">{{ $PostData->category_name }}</p>
                                </div>
                                <a href="{{ route('post.details', $PostData->id) }}"
                                    class="card-title text-decoration-none mb-0">{{ $PostData->title }}</a>
                                <div class="card-text">{!! $PostData->description !!}</div>
                                <div class="d-flex mt-3">
                                    <div class="d-flex" style="width: 85% !important;">
                                        <div>
                                            <img src="index/images/popular-post/img-2.png" alt="Louis Hoebregts"
                                                class="avatar">
                                        </div>
                                        <div>
                                            <h6 class="mb-1">{{ $PostData->auther_name }}</h6>
                                            <p>{{ \Carbon\Carbon::parse($PostData->publish_date)->format('F j, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="w-25 text-end">
                                        <img src="index/images/popular-post/card icon.png" alt=""
                                            class="icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="new-post mt-3 mb-5">
            <div class="d-flex mb-3">
                <div class="post w-100 w-md-50 text-start">
                    <p class="mb-0 fw-bold fs-5">New Post</p>
                </div>
                <a href="" class="arrow w-100 w-md-50 text-end d-flex align-items-center justify-content-end">
                    <span class="mb-0">Show All</span>
                    <i class="fa-solid fa-chevron-right ms-2"></i>
                </a>
            </div>
            <div class="row g-3">
                @foreach ($post as $PostData)
                    @if ($PostData->post_type == 'New Post')
                        <div class="card mb-3 col-12 col-md-6">
                            <div class="row g-0">
                                <div class="col-md-6">
                                    <img src="{{ asset($PostData->thumbnail_image) }}"
                                        class="img-fluid rounded new-post-img" alt="...">
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <a href="{{ route('post.details', $PostData->id) }}"
                                            class="card-title text-decoration-none mb-0">{{ $PostData->title }}</a>
                                        <div class="card-text">{!! $PostData->description !!}</div>
                                        <div class="rotate-icon">
                                            <i class="fa-solid fa-tag fs-4 rotate"></i>
                                            <p class="mb-0 fw-bold">{{ $PostData->category_name }}</p>
                                        </div>
                                        <div class="d-flex mt-3">
                                            <div class="d-flex" style="width: 86% !important;">
                                                <div>
                                                    <img src="index/images/popular-post/img-2.png"
                                                        alt="Louis Hoebregts" class="avatar">
                                                </div>
                                                <div class="ms-3">
                                                    <h6 class="mb-1">{{ $PostData->auther_name }}</h6>
                                                    <p>{{ \Carbon\Carbon::parse($PostData->publish_date)->format('F j, Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="w-25 text-end">
                                                <img src="index/images/popular-post/card icon.png" alt=""
                                                    class="icon">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

        </div>

        <div class="mb-5">
            <div class="d-flex mt-5 mb-4">
                <div class="post w-50 text-start">
                    <p class="mb-0 fw-bold fs-5">Latest videos</p>
                </div>
                <div class="arrow w-50 text-end">
                    <i class="fa-solid fa-chevron-left video-icon"></i>
                    <i class="fa-solid fa-chevron-right video-icon"></i>
                </div>
            </div>
            <div class="leatest-video">
                <div class="tech">
                    <img src="index/images/leatest-video/video.jpg" alt="" class="tech-img">
                    <div class="video-icon">
                        <i class="fa-solid fa-play"></i>
                    </div>
                    <div class="video-img-txt">
                        <h6>How Music Affects Your Brain (Plus 11 Artists To Listen To At Work)</h6>
                        <p>You've read all your free member-only stories, become a member to get unlimited . Your
                            membership fee supports the voices you want to hear more from.</p>
                    </div>
                </div>
                <div class="video d-flex">
                    <div class="row">
                        <div class="card mb-3 col-md-12">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="index/images/leatest-video/01.png" class="img-fluid rounded video-image"
                                        alt="...">
                                </div>
                                <div class="col-md-5">
                                    <div class="card-body">
                                        <h5 class="card-title">5 reasons why you should wrap your hands when boxing
                                        </h5>
                                        <p class="card-text">So, you finally went to your first boxing class and
                                            learned the basics of the sport. You also learned that it's recommended
                                            to wrap your hands before putting on the gloves. But there are times
                                            when you just don't feel like wrapping them and you wonder why you even
                                            need them. Well, this blog is going to explain the benefits of wrapping
                                            your hands.</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="image-container">
                                        <img src="index/images/leatest-video/03.png"
                                            class="img-fluid rounded video-image" alt="...">
                                        <div class="overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 col-md-12">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="index/images/leatest-video/02.png" class="img-fluid rounded video-image"
                                        alt="...">
                                </div>
                                <div class="col-md-5">
                                    <div class="card-body">
                                        <h5 class="card-title">Music Genre Classification with Python</h5>
                                        <p class="card-text">A Guide to analyzing Audio/Music signals in Python —
                                            Music is like a mirror, and it tells people a lot about who you are and
                                            what you care about, whether you like it or not. You've read all your
                                            free memberonly stories, become a member to get unlimited access. Your
                                            membership fee supports the voices you want to hear more from.</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="image-container">
                                        <img src="index/images/leatest-video/04.png"
                                            class="img-fluid rounded video-image" alt="...">
                                        <div class="overlay"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="popular-post mt-5 mb-5">
            <div class="d-flex mb-5 position-relative">
                <div class="post w-50 text-start">
                    <p class="mb-0 fw-bold fs-5">Trendy Post</p>
                </div>
                <div class="arrow w-50 text-end position-relative">
                    <i class="fa-solid fa-chevron-left slick-prev"></i>
                    <i class="fa-solid fa-chevron-right slick-next"></i>
                </div>
            </div>

            <div class="slick-slider">
                @foreach ($post as $PostData)
                    @if ($PostData->post_type == 'Trendy Post')
                        <div class="card">
                            <img src="{{ asset($PostData->thumbnail_image) }}" class="post-image"
                                alt="{{ $PostData->title }} Thumbnail">
                            <div class="card-body">
                                <div class="rotate-icon mb-1">
                                    <i class="fa-solid fa-tag fs-4 rotate"></i>
                                    <p class="mb-0 fw-bold">{{ $PostData->category_name }}</p>
                                </div>
                                <a href="{{ route('post.details', $PostData->id) }}"
                                    class="card-title text-decoration-none mb-0">{{ $PostData->title }}</a>
                                <div class="card-text">{!! $PostData->description !!}</div>
                                <div class="d-flex mt-3">
                                    <div class="d-flex" style="width: 85% !important;">
                                        <div>
                                            <img src="index/images/popular-post/img-2.png" alt="Louis Hoebregts"
                                                class="avatar">
                                        </div>
                                        <div>
                                            <h6 class="mb-1">{{ $PostData->auther_name }}</h6>
                                            <p>{{ \Carbon\Carbon::parse($PostData->publish_date)->format('F j, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="w-25 text-end">
                                        <img src="index/images/popular-post/card icon.png" alt="Card Icon" class="icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="popular-post mt-5 mb-5">
            <div class="d-flex mb-5 position-relative">
                <div class="post w-50 text-start">
                    <p class="mb-0 fw-bold fs-5">Top Post</p>
                </div>
                <div class="arrow w-50 text-end position-relative">
                    <i class="fa-solid fa-chevron-left slick-prev"></i>
                    <i class="fa-solid fa-chevron-right slick-next"></i>
                </div>
            </div>

            <div class="slick-slider">
                @foreach ($post as $PostData)
                    @if ($PostData->post_type == 'Top Post')
                        <div class="card">
                            <img src="{{ asset($PostData->thumbnail_image) }}" class="post-image"
                                alt="Opening Day Of Boating Season, Seattle Wa">
                            <div class="card-body">
                                <div class="rotate-icon mb-1">
                                    <i class="fa-solid fa-tag fs-4 rotate"></i>
                                    <p class="mb-0 fw-bold">{{ $PostData->category_name }}</p>
                                </div>
                                <a href="{{ route('post.details', $PostData->id) }}"
                                    class="card-title text-decoration-none mb-0">{{ $PostData->title }}</a>
                                <div class="card-text">{!! $PostData->description !!}</div>
                                <div class="d-flex mt-3">
                                    <div class="d-flex" style="width: 85% !important;">
                                        <div>
                                            <img src="index/images/popular-post/img-2.png" alt="Louis Hoebregts"
                                                class="avatar">
                                        </div>
                                        <div>
                                            <h6 class="mb-1">{{ $PostData->auther_name }}</h6>
                                            <p>{{ \Carbon\Carbon::parse($PostData->publish_date)->format('F j, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="w-25 text-end">
                                        <img src="index/images/popular-post/card icon.png" alt=""
                                            class="icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="footer">
            <div class="footer1">
                <div class="mega">
                    <div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="dot rounded"></div>
                            <h2 class="ms-2">Mega News</h2>
                        </div>
                        <p class="lorem">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            tempor
                            incididunt ut
                            labore et dolore magna aliqua. Egestas purus viverra accumsan in nisl nisi. Arcu cursus
                            vitae
                            congue mauris rhoncus aenean vel elit scelerisque. In egestas erat imperdiet sed euismod
                            nisi
                            porta lorem mollis. Morbi tristique senectus et netus. Mattis pellentesque id nibh tortor id
                            aliquet lectus proin
                        </p>
                    </div>
                    <div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="dot rounded"></div>
                            <h2 class="ms-2">Newsletters</h2>
                        </div>
                        <div class="d-flex">
                            <input type="text" class="newsletter" placeholder="Write Your Mail...">
                            <i class="fa-solid fa-envelope en-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="category">
                    <div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="dot rounded"></div>
                            <h2 class="ms-2">Categories</h2>
                        </div>
                        <div>
                            <p>Culture</p>
                            <p>Fashion</p>
                            <p>Featured</p>
                            <p>Food</p>
                            <p>Healthy Living</p>
                            <p>Technology</p>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex align-items-center mb-2" style="margin-top: 55px;">
                            <div class="dot rounded"></div>
                            <h2 class="ms-2">Social Network</h2>
                        </div>
                        <div class="d-flex">
                            <button class="insta-btn"><i class="fa-brands fa-instagram"></i>Instagram</button>
                            <button class="twitter-btn"><i class="fa-brands fa-twitter"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer2">
                <div class="comment">
                    <div class="d-flex align-items-center mb-2">
                        <div class="dot rounded"></div>
                        <h2 class="ms-2">New Comments</h2>
                    </div>
                    <div class="mb-3">
                        <h5>ellsmartx</h5>
                        <p>how nice does this look 😍 I feel it should be delicious, thank you</p>
                    </div>
                    <div class="mb-3">
                        <h5>cassia</h5>
                        <p>Take a rest, i'll be cheer up you again in 2 next game go go go</p>
                    </div>
                    <div class="mb-3">
                        <h5>amanda</h5>
                        <p>you were stunning today, jan! 💗 great match 👍🏽👍🏽</p>
                    </div>
                    <div class="mb-3">
                        <h5>Denis Simonassi</h5>
                        <p>It was a great match today Janzi! You did great😉🇩🇪</p>
                    </div>
                </div>
                <div class="follow">
                    <div class="d-flex align-items-center mb-2">
                        <div class="dot rounded"></div>
                        <h2 class="ms-2">Follow on Instagram</h2>
                    </div>
                    <div class="main-image">
                        <img src="index/images/footer/01.png" alt="" class="follow-image">
                        <img src="index/images/footer/02.png" alt="" class="follow-image">
                        <img src="index/images/footer/03.png" alt="" class="follow-image">
                    </div>
                    <div class="main-image">
                        <img src="index/images/footer/04.png" alt="" class="follow-image">
                        <img src="index/images/footer/05.png" alt="" class="follow-image">
                        <img src="index/images/footer/06.png" alt="" class="follow-image">
                    </div>
                    <div class="main-image">
                        <img src="index/images/footer/07.png" alt="" class="follow-image">
                        <img src="index/images/footer/08.png" alt="" class="follow-image">
                        <img src="index/images/footer/09.png" alt="" class="follow-image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="condition">
        <p class="w-50 mb-0 text-start fw-bold text-secondary">privacy policy | terms & conditions</p>
        <p class="w-50 mb-0 text-end fw-bold text-secondary">all copyright &#169; 2022 reserved</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="index/index.js"></script>
    <script>
        $(document).ready(function() {
            $('.slick-slider').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                arrows: true,
                prevArrow: $('.slick-prev'),
                nextArrow: $('.slick-next'),
                responsive: [{
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            });
        });
    </script>
</body>

</html>
