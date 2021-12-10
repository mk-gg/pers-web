@if ($paginator->hasPages())

<div class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
    <nav aria-label="Page navigation example">
        <ul class="pagination mb-0">
            @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#">Previous</a>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" wire:click="previousPage" href="#">Previous</a>
            </li>
            @endif
            

            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <a class="page-link" wire:click="gotoPage({{ $page }})" href="#">{{ $page }}</a>
                        </li>
                        
                        @else
                        <li class="page-item">
                            <a class="page-link" wire:click="gotoPage({{ $page }})" href="#">{{ $page }}</a>
                        </li>
                        @endif
                    @endforeach
                @endif

            @endforeach 
            
            @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" wire:click="nextPage" href="#">Next</a>
            </li>
           
            @else
            <li class="page-item disabled">
                <a class="page-link" wire:click="nextPage" href="#">Next</a>
            </li>
          
            @endif
            
        </ul>
    </nav>
    <div class="fw-normal small mt-4 mt-lg-0">Showing <b>5</b> out of <b>25</b> entries</div>
</div>
@endif