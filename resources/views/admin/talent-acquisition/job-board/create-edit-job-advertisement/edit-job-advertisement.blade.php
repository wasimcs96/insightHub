<div class="modal fade" id="AdvertisementUpdate" tabindex="-1" aria-labelledby="AdvertisementUpdateLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <button 
                type="button" 
                class="p-0 border-0 bg-white" 
                data-bs-dismiss="modal" 
                aria-label="Close"
                style="position: absolute; top: 16px; right: 16px; z-index: 10;"
                >
                <img src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel">
            </button>            
            <div class="modal-body py-0 pt-5 text-center">
                <iconify-icon icon="simple-line-icons:check" width="70" height="70" class="my-5 ml-5"
                        style="color: #99E2A8;"></iconify-icon>
                        <p class="fw-bolder fs-1 lh-1 text-center" style="color: #4B5675;">
                            {{ request()->has('reuse') 
                            ? 'Job Advertisement Reused Successfully!' 
                            : (request()->get('edit') === 'true' 
                                ? 'Job Advertisement Edited Successfully!' 
                                : 'Job Advertisement Created Successfully!') 
                            }}
                        </p>                
                        <p class="m-0 text-center" style="color: #4B5675;">   
                            {{ request()->has('reuse') 
                                ? 'The job advertisement has been successfully reuse and all changes have been saved.' 
                                : (request()->get('edit') === 'true' 
                                    ? 'The job advertisement has been successfully edited and all changes have been saved.' : 'Your job advertisement is now scheduled and ready to attract candidates. You can manage or edit the advertisement at any time from the job board.') 
                            }}
                        </p>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-center">
                    <button class="btn btn-outline" data-bs-dismiss="modal" onclick="navigateToJobBoardReady()">Return to Job Board</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="AdvertisementCreated" tabindex="-1" aria-labelledby="AdvertisementCreatedLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <button 
                type="button" 
                class="p-0 border-0 bg-white" 
                data-bs-dismiss="modal" 
                aria-label="Close"
                style="position: absolute; top: 16px; right: 16px; z-index: 10;"
                >
                <img src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel">
            </button>
        
            <div class="modal-body py-0 pt-5 text-center">
                <iconify-icon icon="simple-line-icons:check" width="70" height="70" class="my-5"
                    style="color: #99E2A8;"></iconify-icon>
                <p class="fw-bolder fs-1 lh-1 text-center" style="color: #4B5675;">  
                    {{ request()->has('reuse') 
                            ? 'Job Advertisement Reused Successfully!' 
                            : (request()->get('edit') === 'true' 
                                ? 'Job Advertisement Edited Successfully!' 
                                : 'Job Advertisement Created Successfully!') 
                            }}
                </p>
                <p class="m-0 text-center" style="color: #4B5675;">
                    {{ request()->has('reuse') 
                                ? 'The job advertisement has been successfully reuse and all changes have been saved.' 
                                : (request()->get('edit') === 'true' 
                                    ? 'The job advertisement has been successfully edited and all changes have been saved.' : 'Your job advertisement is now scheduled and ready to attract candidates. You can manage or edit the advertisement at any time from the job board.') 
                            }}
                </p>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-between gap-2">
                    <button class="btn btn-outline" style="flex: 1 0 0;" data-bs-dismiss="modal" onclick="window.location.href='/admin/talent-acquisition/job-board'">Return to Job Board</button>
                    <button class="btn btn-apply" style="flex: 1 0 0;" onclick="navigateToJobBoardReadyNewPage()">
                        View Job Posting
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

