<!-- START Basic Information -->
<div class="card article" style="margin-bottom: 10px;" v-if="highSchool.length == 0">
    <div class="card-content">
        <div class="content article-body">
            <h5 class="has-text-centered">
                مديرية التربية والتعليم بمحافظة
                {{ $student->school->section->edara->gov->name }}
            </h5>
            <table class="table">
                <tbody>
                    <tr>
                        <td><b>الادارة:</b> {{ $student->school->section->edara->name }}</td>
                        <td><b>اسم الطالب:</b> {{ $student->name }}</td>
                    </tr>
                    <tr>
                        <td><b>القطاع:</b> {{ $student->school->section->name }}</td>
                        <td>
                            <b>النوع: </b>
                            @if($student->gender == 'male')
                                ذكر
                            @elseif($student->gender == 'female')
                                انثى
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>المدرسة:</b> {{ $student->school->name . ' ('  }}
                            @if($student->school->gender == 'male')
                                بنين
                            @elseif($student->school->gender == 'female')
                                بنات
                            @elseif($student->school->gender == 'both')
                                مشتركة
                            @endif
                            {{ ')' }}
                        </td>
                        <td><b>المجموع:</b> {{ $student->total }}</td>
                    </tr>
                    <tr>
                        <td>
                            <b>الرقم القومى:</b> 
                            <input type="text" id="e_national_id" name="national_id" class="custom-input" value="{{ $student->national_id }}">
                        </td>
                        <td>
                            <b>التليفون:</b> 
                            <input type="text" id="e_phone" name="phone" class="custom-input" value="{{ $student->phone }}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>العنوان: </b>
                            <input type="text" id="e_address" name="address" class="custom-input" value="{{ $student->address }}">
                        </td>
                        <td>
                            <button class="button" @click="editStudentData">حفظ التغييرات</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="alert-danger" id="errorMessage"></div>
                            <div class="alert-success" id="successMessage"></div>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
<!-- END Basic Information -->