<div class="badge-group">
    <span class="badge bg-primary-500 text-white mx-5 mb-4" data-v-d70534ce="">
        <span class="inline-flex items-center" data-v-d70534ce="">
            1 = Correct | 0 = Wrong
        </span>
    </span>
</div>
<div class="card-body px-6 pb-6">
    <div class="overflow-x-auto -mx-6 ">
        <span class=" col-span-8  hidden"></span>
        <span class="  col-span-4 hidden"></span>
        <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden ">
                <table id="students-table"
                    class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 ">
                    <thead class=" bg-slate-200 dark:bg-slate-700">

                        <tr>

                            <th scope="col" colspan="2" class="bg-warning-400 color-black table-th text-center">
                                User
                            </th>
                            {{-- <th scope="col" class=" table-th ">
                                
                            </th> --}}

                            <th scope="col" colspan="4" class="bg-success-400 color-black table-th text-center ">
                                Demographic
                            </th>

                            <th scope="col" colspan="50" class=" table-th bg-primary-400 color-black text-center ">
                                CAA
                            </th>

                        </tr>
                        <tr>

                            <th scope="col" class=" table-th ">
                                Name
                            </th>
                            <th scope="col" class=" table-th ">
                                Email
                            </th>

                            <th scope="col" class=" table-th ">
                                Gender
                            </th>

                            <th scope="col" class=" table-th ">
                                Race
                            </th>
                            <th scope="col" class=" table-th ">
                                Age
                            </th>
                            <th scope="col" class=" table-th ">
                                CGPA
                            </th>
                            @foreach (range(1, 50) as $question)
                                <th scope="col" class=" table-th ">
                                    Q.{{ $question }}
                                </th>
                            @endforeach


                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">

                        {{-- {{ dd($table['results']) }} --}}
                        @if (isset($table['results']))

                            @foreach ($table['results'] as $key => $item)
                                <tr>
                                    <td class="table-td ">{{ $item['display_name'] }}</td>
                                    <td class="table-td ">{{ $item['email'] }} </td>
                                    <td class="table-td ">

                                        @if ($item['gender'] == 1)
                                            Male
                                        @else
                                            Female
                                        @endif
                                    </td>
                                    <td class="table-td ">{{ $item['race'] }} </td>
                                    <td class="table-td ">{{ $item['dob'] }} </td>
                                    <td class="table-td ">{{ $item['cgpa'] }} </td>



                                    @for ($i = 1; $i <= 50; $i++)
                                        <td class="table-td ">
                                            @if (isset($item['questions'][$i - 1]))
                                                {{ $item['questions'][$i - 1] }}
                                            @else
                                                Not Answered
                                            @endif
                                        </td>
                                    @endfor


                                </tr>
                            @endforeach

                        @endif

                    </tbody>
                </table>
                {{-- <div id="pagination" class="d-flex justify-content-start mt-3">
                    <!-- Next and Previous page links will be populated dynamically with AJAX -->
                    @if (isset($data['previous']) && $data['previous'] != null)
                        <a class="page-link" href="{{ route('individual.report', ['url' => $data['previous']]) }}">
                            <iconify-icon icon="heroicons-outline:chevron-double-left"></iconify-icon>
                            Previous
                        </a>
                    @else
                        <a class="page-link disabled" href="javascript:void(0)" disabled>
                            <iconify-icon icon="heroicons-outline:chevron-double-left"></iconify-icon>
                            Previous
                        </a>
                    @endif


                    @if (isset($data['next']) && $data['next'] != null)
                        <a class="page-link" href="{{ route('individual.report', ['url' => $data['next']]) }}">
                            Next <iconify-icon icon="heroicons-outline:chevron-double-right">
                            </iconify-icon></a>
                    @else
                        <a class="page-link disabled" href="javascript:void(0)" disabled> Next
                            <iconify-icon icon="heroicons-outline:chevron-double-right"></iconify-icon>
                        </a>
                    @endif
                </div> --}}
            </div>
        </div>
    </div>
</div>
