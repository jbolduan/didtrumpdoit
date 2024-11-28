<?php $statuses = \App\Models\Status::all(); ?>
<?php $categories = \App\Models\Category::all(); ?>

@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="p-1"><img style="display: inline-block; width: 50px;" class="border border-danger border-2 rounded-circle img-fluid float-start" alt="picture of Donald Trump" src="{{URL::asset('/imgs/trump_face.png')}}"></div>
            <div class="p-1"><span class="h1 serif-font">&nbsp;Trump's Promises Tracker</span></div>
        </div>
        <div class="col-auto hstack rounded shadow border" style="background-color: #272a2d;">
            <div class="hstack gap-1">
                    <div class="rounded p-2" style="background-color: #2f3236"><i class="fa fa-xl fa-house"></i></div>
                    <div class=""><span class="h4" id="inaguration-days"><i class="loading">Loading...</i></span><br>
                    <span class="text-secondary">Days Until Inaguration</span></div>
            </div>
            <div class="vr m-2"></div>
            <div class="hstack gap-1">
                <div class="rounded p-2" style="background-color: #2f3236"><i class="fa fa-xl fa-calendar"></i></div>
                <div class=""><span class="h4" id="days-in-office"><i class='loading'>Loading...</i></span><br>
                <span class="text-secondary">Days in Office</span></div>
            </div>
                <div class="vr m-2"></div>
            <div class="hstack gap-1">
                <div class="rounded p-2" style="background-color: #2f3236"><i class="fa fa-xl fa-calendar"></i></div>
                <div class=""><span class="h4" id="days-since-election"><i class='loading'>Loading...</i></span><br>
                <span class="text-secondary">Days Since Election</span></div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid float-start rounded mt-4 border shadow" style="background-color: #272a2d">
    <div class="row">
        <div class="container-fluid">
            <div class="row p-4" style="border-bottom: 1px solid #495057;">
                <div class="col-sm-10">
                    <div class="row">
                        @foreach($statuses as $status)
                        <div class="col-sm-2">
                            <span class="fw-bolder">{{ $status->name }}</span><br>
                            <span class="h2"><i class="fa {{ $status->fa_icon }}" style="color: {{ $status->color }}; font-size: 0.6em;"></i>&nbsp;<span id="status-count-{{ $status->id }}">...</span></span>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-2 border-start">
                    <span id="total-promises" class="h1">...</span><br>
                    <span class="fw-bolder text-secondary">Total Promises</span>
                </div>
            </div>
            <div class="row">
                <div class="col-auto p-2">
                    <canvas id="statusChart"></canvas>
                </div>
                <div class="col p-4">
                    <p>This website is to track all the promises made by Donald Trump, Republican politicians, and conservative influencers. 
                        The intention is to identify what was followed through on, what was not, and what was an outright lie. 
                        This is a collaborative effort and you can participate by using the <a href="https://github.com/jbolduan/didtrumpdoit">GitHub repository</a> 
                        either directly by contributing changes to code base or through opening issues/discussions to have others add or update items.</p>
                    <p>This site was created by the <a href="https://destiny.gg">destiny.gg</a> community.</p><br>
                    <div id="share-buttons" class="text-center">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="https://bsky.app/intent/compose?text=Did%20Trump%20Do%20It?%0Ahttps%3A//didtrumpdoit.com"
                                    target="_blank" style="color:#0085ff; text-align: center;"><i
                                        class="fa-brands fa-2x fa-bluesky"></i><br>Share on BlueSky</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://x.com/share?url=https://didtrumpdoit.com/" target="_blank"
                                    style="color: #fff; text-align: center;">
                                    <i class="fa-brands fa-2x fa-x-twitter"></i><br>Share on X
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="http://www.reddit.com/submit?url=https://didtrumpdoit.com&title=DidTrumpDoIt.com"
                                    target="_blank" style="color:#ff4500; text-align: center;">
                                    <i class="fa-brands fa-2x fa-reddit-alien"></i><br>Share on Reddit
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://www.facebook.com/sharer.php?u=https://didtrumpdoit.com" target="_blank"
                                    style="color:#0866ff; text-align: center;">
                                    <i class="fa-brands fa-2x fa-facebook-square"></i><br>Share on Facebook
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container fluid">
    <div class="row pt-4">
        <span class="h2 serif-font">Explore Promises</span>
        <span class="text-secondary">Filter promises by status or type</span>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="input-group mt-2">
                <span class="input-group-text"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" id="search" placeholder="Search for a promise...">
                <button class="btn btn-primary">Search</button>
            </div>
        </div>
        <div class="col col-md-auto">
            <div class="dropdown mt-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                    Filter by Status
                </button>
                <ul class="dropdown-menu p-2">
                    @foreach($statuses as $status)
                    <div class="input-group p-1">
                        <li>
                            
                            <label class="form-check-label" for="status-checkbox-{{ $status->id }}"><input class="form-check-input" type="checkbox" value="{{$status->id}}" id="status-checkbox-{{ $status->id }}" checked> {{ $status->name }}</label>
                        </li>
                    </div>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col col-md-auto">
            <div class="dropdown mt-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                    Filter by Category
                </button>
                <ul class="dropdown-menu p-2">
                    @foreach($categories as $category)
                    <div class="input-group p-1">
                        <li> 
                            <label class="form-check-label text-nowrap" for="category-checkbox-{{ $category->id }}"><input class="form-check-input" type="checkbox" value="{{$category->id}}" id="category-checkbox-{{ $category->id }}" @if(strpos($category, "Promise") == false) checked @endif> {{ $category->name }}</label>
                        </li>
                    </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="row pt-4">
        <div class="col-lg-12">
            @foreach($categories as $category)
            <button id="category-filter-btn-{{ $category->id }}" class="btn rounded-pill category-pill-filter-{{ $category->id }} m-1" style="display: none" value="{{ $category->id}}"><i class="fa-regular fa-circle-xmark"></i> {{ $category->name }}</button>
            @endforeach
            @foreach($statuses as $status)
            <button id="status-filter-btn-{{ $status->id }}" class="btn rounded-pill status-pill-filter-{{ $status->id }} m-1" style="display: none" value="{{ $status->id }}"><i class="fa-regular fa-circle-xmark"></i> {{ $status->name }}</button>
            @endforeach
            <button class="btn btn-primary m-1" id="filterReset">Reset Filters <span id="resetBadge" class="badge text-bg-secondary">...</span></button>
        </div>
    </div>
</div>
<div class="pt-4">
    <table id="dataTable" class="table table-hover table-striped table-curved">
        <!-- <thead>
            <td><id</td>
            <td>Title</td>
            <td>Description</td>
            <td>Status</td>
            <td>status details</td>
            <td>Categories</td>
        </thead> -->
        <tbody>
            <?php $statementCounter = 1 ?>
            @foreach($statements as $statement)
            <?php    $username = $statement->user->username ?? 'N/A'; ?>
            <?php    $public = $statement->is_public ? 'Yes' : 'No'; ?>
            <tr class="status-{{$statement->status->id}}" data-href="<?php echo url("/statements/{$statement->id}"); ?>">
                <td >{{ $statementCounter }}</td>
                <td class="dummy-class-for-count">
                    {{ $statement->title }}
                    <?php
                    $urls = array_filter(preg_split("/\r\n|\n|\r/", $statement->urls));
                    $urlsCount = count($urls);
                    ?>
                    @if($urlsCount > 0)
                    <?php        $counter = 0; ?>
                    @foreach($urls as $link)
                    <a href="{{ $link }}">[{{ ($counter + 1) }}]</a>
                    <?php            $counter++; ?>
                    @endforeach
                    @else
                    N/A
                    @endif
                </td>
                <td><span id="status-{{$statement->status->id}}" class="badge rounded-pill status-pill-{{ $statement->status->id }}"><i class="fa fa-fw {{$statement->status->fa_icon}}"></i> {{ $statement->status->name }}</span></td>
                <td>
                    <ul class="list-unstyled" style="margin: 0;">
                        @if($statement->category->count() > 0)
                        @foreach($statement->category as $category)
                        <li class="list-item"><span class="badge rounded-pill category-pill-{{ $category->id }}"><i class="fa fa-fw {{$category->fa_icon}}"></i> {{ $category->name }}</span></li>
                        @endforeach
                        @else
                        <li class="list-item"><span class="badge rounded-pill bg-secondary">N/A</span></li>
                        @endif
                    </ul>
                </td>
                <td>
                    <i class="fa-solid fa-chevron-right"></i>
                </td>
            </tr>
            <?php    $statementCounter++ ?>
            @endforeach
        </tbody>
    </table>
</div>

<script type="text/javascript">
    

$(document).ready(function() {

    // Setup the chart
    const statusChart = new Chart("statusChart", {
        type: "doughnut",
        options: {
            animation: {
                duration: 0
            },
            title: {
                display: true,
                text: 'Promises by Status'
            },
            responsive: false,
            maintainAspectRatio: false,
            borderColor: '#000000',
            borderWidth: 1,
            cutout: 70,
            plugins: {
                legend: {
                    display: true,
                    position: 'left',
                    labels: {
                        usePointStyle: true,
                        color: 'white'
                    }
                }
            }
        }
    });

    function updateStatusCountsAndChart() {
        // Pull all promises that are visible.
        var totalPromises = $('.dummy-class-for-count:visible').length;
        $('#total-promises').text(totalPromises);
        
        // Setup chart variables and current status counts
        var statusNames = [];
        var statusColors = [];
        var statusCounts = [];

        @foreach($statuses as $status)
            var visibleStatus{{ $status->id }} = $('.status-pill-{{ $status->id }}:visible').length;
            $('#status-count-{{ $status->id }}').text(visibleStatus{{ $status->id }});
            statusNames.push('{{ $status->name }}');
            statusCounts.push(visibleStatus{{ $status->id }});
            statusColors.push('{{ $status->color }}');
        @endforeach

        var data = {
            labels: statusNames,
            datasets: [{
                backgroundColor: statusColors,
                data: statusCounts
            }]
        }

        statusChart.data = data;
        statusChart.update();

        var hiddenTableRows = $('#dataTable tr:hidden').length;
        $('#resetBadge').text(hiddenTableRows);
    }

    // Setup checkbox handling onload for categories
    $('input[type="checkbox"][id^="category-checkbox"').each(function() {
        console.log('category checkbox changed');
        var category= $(this).val();
        if($(this).is(":checked")) {
            $('.category-pill-' + category).closest('tr').show();
            $('#category-filter-btn-' + category).hide();
        } else {
            $('.category-pill-' + category).closest('tr').hide();
            $('#category-filter-btn-' + category).show();
        }
        updateStatusCountsAndChart();
    })

    // Setup checkbox handling for categories
    $('input[type="checkbox"][id^="category-checkbox"').change(function() {
        console.log('category checkbox changed');
        var category= $(this).val();
        if($(this).is(":checked")) {
            $('.category-pill-' + category).closest('tr').show();
            $('#category-filter-btn-' + category).hide();
        } else {
            $('.category-pill-' + category).closest('tr').hide();
            $('#category-filter-btn-' + category).show();
        }
        updateStatusCountsAndChart();
    })

    // Setup checkbox handling for statuses
    $('input[type="checkbox"][id^="status-checkbox"').change(function() {
        console.log('status checkbox changed');
        var status = $(this).val();
        if($(this).is(":checked")) {
            $('.status-pill-' + status).closest('tr').show();
            $('#status-filter-btn-' + status).hide();
        } else {
            $('.status-pill-' + status).closest('tr').hide();
            $('#status-filter-btn-' + status).show();
        }
        updateStatusCountsAndChart();
    })

    // Setup filter button handling for categories
    $('button[id^="category-filter-btn"').click(function() {
        var category = $(this).val();
        $('input[type="checkbox"][id="category-checkbox-' + category + '"]').click();
    })

    // Setup filter button handling for statuses
    $('button[id^="status-filter-btn"').click(function() {
        var status = $(this).val();
        $('input[type="checkbox"][id="status-checkbox-' + status + '"]').click();
    })

    $('#search').on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#dataTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        updateStatusCountsAndChart();
    });

    $('#filterReset').click(function() {
        console.log('resetting filters');
        $('input[type="checkbox"][id^="category-checkbox"]:not(:checked)').click();
        $('input[type="checkbox"][id^="status-checkbox"]:not(:checked)').click();
        $('#search').prop('value', '');
        $('#search').trigger('keyup');

        updateStatusCountsAndChart();
    })

    var hiddenTableRows = $('#dataTable tr:hidden').length;
    $('#resetBadge').text(hiddenTableRows);

    updateStatusCountsAndChart();

    $('#dataTable tr').click(function() {
        window.location = $(this).data('href');
    })
});

</script>
@endsection
