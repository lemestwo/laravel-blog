<!-- SEARCH SIDEBAR -->
<div class="card mb-3">
    <div class="card-body">
        <form class="input-group" method="get" action="{{ route('posts.index') }}">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="search" id="search">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ABOUT ME SIDEBAR -->
<div class="card mb-3">
    <h6 class="card-header text-white bg-secondary">About Me</h6>
    <div class="text-center">
        <img
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQsEx6tS237fLYZi9di_Iqa1D3BJ5RuAtGhhHXVBWKey1vM8A_U&usqp=CAU"
            class="card-img-top rounded-circle about-me" alt="About Me">
    </div>
    <div class="card-body text-center">
        <h5 class="card-title"> Lorem Ipsum Dolor</h5>
        <p class="card-text">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Accusamus aperiam asperiores aut consequuntur cupiditate dignissimos distinctio eos.</p>
    </div>
    <div class="card-footer text-center">
        <a href="#" class="text-secondary" title="Facebook"><i class="fab fa-facebook fa-2x"></i></a>
        <a href="#" class="text-secondary" title="Twitter"><i class="fab fa-twitter fa-2x"></i></a>
        <a href="#" class="text-secondary" title="Github"><i class="fab fa-github fa-2x"></i></a>
        <a href="#" class="text-secondary" title="Youtube"><i class="fab fa-youtube fa-2x"></i></a>
    </div>
</div>

<!-- POPULAR POSTS SIDEBAR -->
<div class="card mb-3">
    <h6 class="card-header text-white bg-secondary">Popular Posts</h6>
    <ul class="list-group list-group-flush">

        @for ($i = 0; $i < 5; $i++)
            <li class="list-group-item">
                <h5 class="card-title"> Lorem Ipsum Dolor</h5>
                <div class="card-text">
                    <div class="row small text-muted">
                        <div class="col">
                            <i class="fas fa-calendar-alt"></i>
                            May 20, 2020
                        </div>
                        <div class="col-auto">
                            <a href="#" class="card-link">Read More</a>
                        </div>
                    </div>
                </div>
            </li>
        @endfor

    </ul>
</div>

<!-- CLOUD TAG SIDEBAR -->
<div class="card mb-3">
    <h6 class="card-header text-white bg-secondary">Popular Tags</h6>
    <div class="card-body text-center">
        <p class="card-text cloud-tag">
            <a class="btn btn-outline-secondary btn-sm" href="#" role="button">Tag1</a>
            <a class="btn btn-outline-secondary btn-sm" href="#" role="button">Taggggaa</a>
            <a class="btn btn-outline-secondary btn-sm" href="#" role="button">Tkasjjmc</a>
            <a class="btn btn-outline-secondary btn-sm" href="#" role="button">Taggggaa</a>
            <a class="btn btn-outline-secondary btn-sm" href="#" role="button">Tkasjjmc</a>
        </p>
    </div>
</div>
