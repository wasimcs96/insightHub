<div class="card card-body flex flex-col p-6  shadow border">
    <header
        class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
        <div class="flex-1">
            <div class="card-title text-slate-900 dark:text-white">Filter</div>
        </div>
    </header>
    <form action="">
        <div class="grid md:grid-cols-3 grid-cols-1 gap-6">
            <div class="w-1">
                <label for="basicSelect" class="form-label">Select CAA Set</label>
                <select name="gender" id="basicSelect" class="form-control w-full mt-2">
                    <option selected="Selected" value=""
                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        Select Set</option>
                    <option value=""
                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">All
                    </option>
                    <option value="1"
                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        1
                    </option>
                    {{-- <option value="2"
                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        2</option> --}}
                </select>
            </div>
            <div>
                <label for="default-picker" class=" form-label">From</label>
                <input class="form-control py-2  " id="default-picker" value="{{ request('from') }}"
                    type="date" name="from">
            </div>

            <div>
                <label for="default-picker" class=" form-label">to</label>
                <input class="form-control py-2 " id="default-picker" value="{{ request('to') }}"
                    type="date" name="to">
            </div>
            <input type="hidden" name="tabtype" value="demograph">
            <div>
                <label for="basicSelect" class="form-label">Year of Study</label>
                <select name="yearstudy" id="basicSelect" class="form-control w-full mt-2">
                    <option value=""
                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        All</option>
                    @foreach ($yearstudy->data as $data)
                        <option @if (request('yearstudy') == $data->Id) selected @endif
                            value="{{ $data->Id ?? '' }}"
                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                            {{ $data->Name ?? '' }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="basicSelect" class="form-label">Scope of Study</label>
                <select name="scopestudy" id="basicSelect" class="form-control w-full mt-2">
                    <option value=""
                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        All</option>
                    @foreach ($scopestudy->data as $data)
                        <option @if (request('scopestudy') == $data->Id) selected @endif
                            value="{{ $data->Id ?? '' }}"
                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                            {{ $data->Name ?? '' }}</option>
                    @endforeach

                </select>
            </div>


            <div>
                <label for="basicSelect" class="form-label">Gender</label>
                <select name="gender" id="basicSelect" class="form-control w-full mt-2">
                    <option selected="Selected" value=""
                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        Select Gender</option>
                    <option value=""
                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">All
                    </option>
                    <option @if (request('gender') == 1) selected @endif value="1"
                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        Male
                    </option>
                    <option @if (request('gender') == 2) selected @endif value="2"
                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                        Female</option>
                </select>
            </div>


        </div>
        <div class="filter-btn mt-4"
            style=" display: flex; justify-content: end; align-items: end;                        ">
            <button class="btn inline-flex justify-center btn-success shadow-base2">Filter
                data</button>
                <a href="{{url()->current() }}" class="btn btn-warning ml-2 inline-flex justify-center btn-success shadow-base2">Reset</a>
        </div>
    </form>


</div>