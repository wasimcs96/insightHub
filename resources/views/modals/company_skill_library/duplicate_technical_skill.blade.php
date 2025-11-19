     <div class="modal-body">
         <div class="custom-popup-body ">
             <p class="m-0">Existing Technical Skill Title</p>
             <p class="mb-7"><b>{{ $skillName ?? '' }}</b></p>
             <label class="form-label">New Technical Skill Title</label>
             <div class="input-wrapper d-flex">
                 <input type="text" id="skillInput" class="border-0 w-100" placeholder="New Technical Skill Title" />
             </div>
             <small id="errorText" style="color: red; display: none; margin-top:3px;">This
                 field is required</small>
         </div>
             <div class="modal-footer justify-content-center p-0 pt-7 border-0">
             <button type="button" class="fs-6 grey-outline-popup flex-grow-0 px-14"
            data-bs-dismiss="modal">Cancel</button>
             <button type="button" data-modal-submit class="text-center fs-6 orange-fill-popup flex-grow-0 px-14">
                 Create
             </button>
         </div>
     </div>





