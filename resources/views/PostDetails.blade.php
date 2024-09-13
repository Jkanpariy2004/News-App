<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mega News Post Details </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="/index/css/post_details.css">

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
    <div class="container" style="padding-top: 100px;">
        <div class="row">
            <div class="col-md-9">
                <div class="post-details">
                    <h2 class="head">{{ $post_details->title }}</h2>
                    <div>
                        <img src="/{{ $post_details->thumbnail_image }}" alt="" class="river-img">
                    </div>
                    <div class="my-3 d-flex text-secondary fw-bold gap-3 justify-content-center">
                        <div class="date">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>{{ \Carbon\Carbon::parse($post_details->publish_date)->format('F j, Y') }}</span>
                        </div>
                        <div class="comm">
                            <i class="fa-solid fa-comment"></i>
                            <span>comments : 35</span>
                        </div>
                        <div class="file">
                            <i class="fa-solid fa-folder"></i>
                            <span>Category : {{ $post_details->category_name }}</span>
                        </div>
                    </div>
                    <div>
                        <h5>{{ $post_details->title }}</h5>
                        <p>{!! $post_details->description !!}</p>
                    </div>
                    {{-- <div>
                        <img src="/index/images/top-post/01.png" alt="" class="river-img object-fit-contain">
                    </div>
                    <div class="my-3">
                        <h5>Not how long, but how well you have lived is the main thing.</h5>
                        <p class="my-1 lh-lg">When you are ready to indulge your sense of excitement, check out the
                            range of water- sports opportunities at the resort’s on-site water-sports center. Want to
                            leave your stress on the water? The resort has kayaks, paddleboards, or the low-key pedal
                            boats. Snorkeling equipment is available as well, so you can experience the ever-changing
                            undersea environment.</p>
                        <p class="my-1 lh-lg">Not only do visitors to a bed and breakfast get a unique perspective on
                            the place they are visiting, they have options for special packages not available in other
                            hotel settings. Bed and breakfasts can partner easily with local businesses for a smoothly
                            organized and highly personalized vacation experience. The Fife and Drum Inn offers options
                            such as the Historic Triangle Package that includes three nights at the Inn, breakfasts, and
                            admissions to historic Williamsburg, Jamestown, and Yorktown. Bed and breakfasts also lend
                            themselves to romance.</p>
                        <p class="my-1 lh-lg">Part of the charm of a bed and breakfast is the uniqueness; art, décor,
                            and food are integrated to create a complete experience. For example, the Fife and Drum
                            retains the colonial feel of the area in all its guest rooms. Special features include
                            antique furnishings, elegant four poster beds in some guest rooms, as well folk art and
                            artifacts from the restoration period of the historic area available for guests to enjoy.
                        </p>
                    </div> --}}
                </div>
                <div class="comment mt-5 mb-5">
                    <div class="d-flex">
                        <div class="dot rounded"></div>
                        <h5 class="mb-0 mx-2">Comments</h5>
                    </div>
                    <div>
                        <div>
                            <div class="d-flex mt-4">
                                <div class="d-flex" style="width: 85% !important;">
                                    <div>
                                        <img src="/index/images/popular-post/img-2.png" alt="Louis Hoebregts"
                                            class="comment-avatar">
                                    </div>
                                    <div class="mt-1">
                                        <h6 class="mb-1">Jon Kantner</h6>
                                        <div class="date fw-bold text-secondary">
                                            <i class="fa-solid fa-calendar-days"></i>
                                            <span>July 14 , 2022</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-secondary mt-2"><i class="fa-solid fa-reply"></i><span
                                            class="mx-2">Reply</span></button>
                                </div>
                            </div>
                            <div>
                                <p class="mt-3">When you are ready to indulge your sense of excitement, check out the
                                    range of water-
                                    sports opportunities at the resort’s on-site water-sports center. Want to leave your
                                    stress on the water? The resort has kayaks, paddleboards, or the low-key pedal
                                    boats.
                                </p>
                            </div>
                        </div>
                        <div class="box">
                            <div>
                                <div class="d-flex" style="width: 85% !important;">
                                    <div>
                                        <img src="/index/images/popular-post/img-2.png" alt="Louis Hoebregts"
                                            class="comment-avatar">
                                    </div>
                                    <div class="mt-1">
                                        <h6 class="mb-1">Jon Kantner</h6>
                                        <div class="date fw-bold text-secondary">
                                            <i class="fa-solid fa-calendar-days"></i>
                                            <span>2022 04 July</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-3">
                                    <p>a river or a lake island may be called an eyot or ait, and a small island off the
                                        coast may be called a holm. Sedimentary islands in the Ganges delta are called
                                        chars. A grouping of geographically or geologically related islands, such as the
                                        Philippines, is referred to as an archipelago. </p>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex" style="width: 85% !important;">
                                    <div>
                                        <img src="/index/images/popular-post/img-2.png" alt="Louis Hoebregts"
                                            class="comment-avatar">
                                    </div>
                                    <div class="mt-1">
                                        <h6 class="mb-1">behzad pashaei</h6>
                                        <div class="date fw-bold text-secondary">
                                            <i class="fa-solid fa-calendar-days"></i>
                                            <span>2022 04 July</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-3">
                                    <p>Oceanic islands are often considered to be islands that do not sit on continental
                                        shelves. Other definitions limit the term to only refer to islands with no past
                                        geological connections to a continental landmass.The vast majority are volcanic
                                        in origin, such as Saint Helena in the South Atlantic Ocean.</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex mt-4">
                                <div class="d-flex" style="width: 85% !important;">
                                    <div>
                                        <img src="/index/images/popular-post/img-2.png" alt="Louis Hoebregts"
                                            class="comment-avatar">
                                    </div>
                                    <div class="mt-1">
                                        <h6 class="mb-1">Jon Kantner</h6>
                                        <div class="date fw-bold text-secondary">
                                            <i class="fa-solid fa-calendar-days"></i>
                                            <span>July 14 , 2022</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-secondary mt-2"><i class="fa-solid fa-reply"></i><span
                                            class="mx-2">Reply</span></button>
                                </div>
                            </div>
                            <div>
                                <p class="mt-3">When you are ready to indulge your sense of excitement, check out the
                                    range of water-
                                    sports opportunities at the resort’s on-site water-sports center. Want to leave your
                                    stress on the water? The resort has kayaks, paddleboards, or the low-key pedal
                                    boats.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="comment mt-5">
                    <div class="d-flex">
                        <div class="dot rounded"></div>
                        <h5 class="mb-0 mx-2">Add A Comment</h5>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div>
                                <h6 class="my-3">Name</h6>
                                <input type="text" class="form-control comm-inp" placeholder="Enter Name">
                            </div>
                            <div>
                                <h6 class="my-3">Website</h6>
                                <input type="text" class="form-control comm-inp" placeholder="Enter Website">
                            </div>
                            <div>
                                <h6 class="my-3">Email</h6>
                                <input type="text" class="form-control comm-inp" placeholder="Enter Email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="my-3">Comment</h6>
                            <textarea class="form-control" cols="30" rows="9" placeholder="Write a Comment"></textarea>
                        </div>
                    </div>
                    <div class="rating gap-3">
                        <div class="d-flex comm-box mt-4 w-80">
                            <div class="w-50">
                                <h6 class="my-3 mx-2 rate">Rate the usefulness of the article</h6>
                            </div>
                            <div class="w-50">
                                <div class="gap-5 d-flex my-3">
                                    <img src="/index/images/icon/icon-3.png" alt=""
                                        style="cursor: pointer; object-fit: contain;">
                                    <img src="/index/images/icon/icon-2.png" alt=""
                                        style="cursor: pointer; object-fit: contain;">
                                    <img src="/index/images/icon/icon-1.png" alt=""
                                        style="cursor: pointer; object-fit: contain;">
                                    <img src="/index/images/icon/icon-4.png" alt=""
                                        style="cursor: pointer; object-fit: contain;">
                                    <button class="btn btn-success"><img src="/index/images/icon/icon.png"
                                            alt="" style="cursor: pointer; object-fit: contain;"><span
                                            class="mx-2">Good</span></button>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 w-20">
                            <button class="btn btn-danger btn-lg mt-3 fw-bold"><img
                                    src="/index/images/icon/comment.png" alt=""
                                    style="cursor: pointer; object-fit: contain;"><span class="mx-2 fs-6">Send
                                    Comment</span></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="d-flex mt-3">
                    <div class="d-flex" style="width: 85% !important;">
                        <div>
                            <img src="/index/images/popular-post/img-2.png" alt="Louis Hoebregts" class="avatar">
                        </div>
                        <div>
                            <h6 class="mb-1">Louis Hoebregts</h6>
                            <button class="btn btn-danger fw-bold btn-sm"><i class="fa-solid fa-plus"></i><span
                                    class="mx-2">Follow</span></button>
                        </div>
                    </div>
                    <div class="w-25 text-end">
                        <span>27 Post</span>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="d-flex">
                        <div class="dot rounded"></div>
                        <h5 class="mb-0 mx-2">Tags</h5>
                    </div>
                    <div class="d-flex flex-wrap gap-2 mt-3">
                        <span class="badge bg-light text-dark">Montenegro</span>
                        <span class="badge bg-light text-dark">Visit Croatia</span>
                        <span class="badge bg-light text-dark">Luxury Travel</span>
                        <span class="badge bg-light text-dark">Travel Log</span>
                        <span class="badge bg-light text-dark">Paradise Island</span>
                        <span class="badge bg-light text-dark">Travel Info</span>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="d-flex">
                        <div class="dot rounded"></div>
                        <h5 class="mb-0 mx-2">Top Post</h5>
                    </div>
                    @foreach ($post as $PostData)
                        @if ($PostData->post_type == 'Top Post')
                            <div class="mt-3">
                                <div class="d-flex mb-3">
                                    <div>
                                        <img src="/{{ $PostData->thumbnail_image }}" alt="Louis Hoebregts"
                                            class="top-post-avatar">
                                    </div>
                                    <div class="mt-2">
                                        <h6 class="top-post-txt mb-1">{{ $PostData->title }}</h6>
                                        <span class="top-post-span">{{ $PostData->category_name }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="popular-post mt-5 mb-5">
            <div class="d-flex mb-3 position-relative">
                <div class="post w-50 text-start d-flex">
                    <div class="dot rounded"></div>
                    <p class="mb-0 fw-bold fs-5 mx-2">Related Post</p>
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
                                <p class="card-title mb-0">{{ $PostData->title }}</p>
                                <div class="card-text">{!! $PostData->description !!}</div>
                                <div class="d-flex mt-3">
                                    <div class="d-flex" style="width: 85% !important;">
                                        <div>
                                            <img src="/index/images/popular-post/img-2.png" alt="Louis Hoebregts"
                                                class="avatar">
                                        </div>
                                        <div>
                                            <h6 class="mb-1">{{ $PostData->auther_name }}</h6>
                                            <p>{{ \Carbon\Carbon::parse($PostData->publish_date)->format('F j, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="w-25 text-end">
                                        <img src="/index/images/popular-post/card icon.png" alt=""
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
                        <img src="/index/images/footer/01.png" alt="" class="follow-image">
                        <img src="/index/images/footer/02.png" alt="" class="follow-image">
                        <img src="/index/images/footer/03.png" alt="" class="follow-image">
                    </div>
                    <div class="main-image">
                        <img src="/index/images/footer/04.png" alt="" class="follow-image">
                        <img src="/index/images/footer/05.png" alt="" class="follow-image">
                        <img src="/index/images/footer/06.png" alt="" class="follow-image">
                    </div>
                    <div class="main-image">
                        <img src="/index/images/footer/07.png" alt="" class="follow-image">
                        <img src="/index/images/footer/08.png" alt="" class="follow-image">
                        <img src="/index/images/footer/09.png" alt="" class="follow-image">
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
    <script src="/index/index.js"></script>
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
