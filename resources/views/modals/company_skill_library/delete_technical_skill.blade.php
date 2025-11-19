
                 <div class="modal-body text-center pt-4">
                     <iconify-icon icon="ep:warning" width="70" height="70"
                         style="color: #FABB6E;"></iconify-icon>
                     <h4 class="my-5">Delete Technical Skill?</h4>
                         <p class="mx-12 my-5 para">This action will remove
                             the
                             technical skill, <b >{{ $skillName ?? ''}}</b>
                             from all associated job positions listed
                             below:</p>
                         <div class="bg-modal-content">
                             <p class="m-0" id="affectedJobList">
                         </div>
                         <div class="d-flex align-items-center justify-content-center gap-2">
                             <button class="btn btn-outline m-0" data-bs-dismiss="modal">Discard</button>
                             <form id="deleteSkillForm" method="POST"
                                 action="{{ route('sector.skills.company.destroy', $skillId) }}"
                                 style="display: inline;">
                                 <input type="hidden" name="skill_type" value="{{ $skillType ?? '' }}"/>
                                 @csrf
                                 @method('DELETE')
                                 <button  data-modal-submit class="btn btn-danger text-white m-0"
                                     style="background: #F7941C;">Confirm</button>
                             </form>
                         </div>
      
                 </div>

