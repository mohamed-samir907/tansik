<h5 class="has-text-centered" style="margin-top: 15px">
    <span>تعديل الرغبات</span>
</h5>
<table>
    <tbody>
        
        <tr>
            <td class="col s12">
                <label for="type" style="font-weight: bold">اختر التصنيف</label>
                <select id="type" name="type" size="5" id="schoolsSelect" @change="addSchoolsTo"
                    style="width: 100%; border-radius: 5px;border-color: #3273dc;box-shadow: 0 0 0 0.125em rgba(50,115,220,.25);">
                    <option style="padding: 8px 5px" selected>اختر ثلاث رغبات</option>
                    <optgroup style="padding: 8px 5px" label="صتاعى">
                        @foreach($industrial as $school)
                            <option class="option" data-id="{{ $school->id }}" data-value="{{ $school->name }}" style="padding: 8px 5px" value="{{ $school->id }}">{{ $school->name }}</option>
                        @endforeach
                    </optgroup>
                    <optgroup style="padding: 8px 5px" label="تجارى">
                        @foreach($trading as $school)
                            <option class="option" data-id="{{ $school->id }}" data-value="{{ $school->name }}" style="padding: 8px 5px" value="{{ $school->id }}">{{ $school->name }}</option>
                        @endforeach
                    </optgroup>
                    <optgroup label="زراعى">
                        @foreach($agricultural as $school)
                            <option class="option" data-id="{{ $school->id }}" data-value="{{ $school->name }}" style="padding: 8px 5px" value="{{ $school->id }}">{{ $school->name }}</option>
                        @endforeach
                    </optgroup>
                    <optgroup label="اخرى">
                        @foreach($other as $school)
                            <option class="option" data-id="{{ $school->id }}" data-value="{{ $school->name }}" style="padding: 8px 5px" value="{{ $school->id }}">{{ $school->name }}</option>
                        @endforeach
                    </optgroup>

                </select>
            </td>
        </tr>

    </tbody>
</table>

{{-- Start Selected Schools --}}
<div class="has-background-light"
    style="margin-top: 15px; margin-bottom: 10px; padding: 10px"
    v-if="selectedSchools.length > 0 && schoolType != 'high'">
    <form method="POST" action="{{ route('front.add_ragaba') }}">
        <div class="row justify-content-left">
            {{ csrf_field() }}
            <table id="myTable">
                <tbody>
                    <tr v-for="school in selectedSchools">
                        <td :data-id="school.id">
                            <input type="hidden" name="school[]" :value="school.id">
                            @{{ school.name }}
                        </td>
                        <td>
                            <button class="button is-danger is-outlined is-small" @click="deleteSelectedSchool(school)">×</button>
                        </td>
                    </tr>
                </tbody>

            </table>
            <input class="button is-success" type="submit" value="تأكيد الرغبات">
        </div>
    </form>
</div>