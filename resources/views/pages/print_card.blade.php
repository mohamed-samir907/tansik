<div class="card article" style="margin-bottom: 10px;" v-if="highSchool.length >= 1" id="card-print-high">
    <div class="card-content">
        <div class="content article-body">
            <div class="columns">
                <div class="column is-10">
                    <p style="font-weight: bold;">محافظة المنيا</p>
                    <p style="font-weight: bold;">مديرية التربية والتعليم</p>
                    <p style="font-weight: bold;">تنسق التعليم العام 2019/2020</p>
                </div>
                <div class="column">
                    <img src="{{ url('images/logo.jpg') }}">
                </div>
            </div>
            <table class="table">
                <h5 class="has-text-centered has-background-grey-lighter" style="padding: 10px">
                    بطاقة ترشيح طالب - التعليم العام
                </h5>
                <tbody>
                    <tr>
                        <td><b>اسم الطالب:</b></td>
                        <td>{{ $student->name }}</td>
                    </tr>
                    <tr>
                        <td><b>الرقم القومى:</b></td>
                        <td>{{ $student->national_id }}</td>
                    </tr>
                    <tr>
                        <td><b>رقم الجلوس:</b></td>
                        <td>{{ $student->s_number }}</td>
                    </tr>
                    <tr>
                        <td><b>الادارة:</b></td>
                        <td>{{ $student->school->section->edara->name }}</td>
                    </tr>
                    <tr>
                        <td><b>المدرسة:</b></td>
                        <td>{{ $student->school->name }}</td>
                    </tr>
                    <tr>
                        <td><b>المجموع:</b></td>
                        <td>{{ $student->total }}</td>
                    </tr>
                    <tr>
                        <td><b>التليفون:</b></td>
                        <td>{{ $student->phone }}</td>
                    </tr>
                    <tr>
                        <td><b>العنوان:</b></td>
                        <td>{{ $student->address }}</td>
                    </tr>
                    <tr class="has-background-grey-lighter">
                        <td><b>المدرسة الثانوية المرشح لها:</b></td>
                        <td v-if="highSchool.length == 1">
                            <b>@{{ highSchool[0].name }}</b>
                        </td>
                        <td v-else>
                            <div v-for="school in highSchool">
                                <b>@{{ school.name }}</b><br>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"
                        style="border-bottom: 0; padding-top: 10px; padding-bottom: 0px;"
                        ><h5><u>الاوراق المطلوبة</u></h5></td>
                    </tr>
                    <tr>
                        <td style="padding: 0" colspan="2">
                            <ol>
                                <li>ملف تقديم (مدارس تعليم ثانوى)</li>
                                <li>شهادة ميلاد كمبيوتر ( اصل + 4 صور)</li>
                                <li>اصل الشهادة الاعدادية + 4 صور</li>
                                <li>عدد 6 صور شخصية 4×6</li>
                            </ol>
                            <div class="has-text-centered">
                                <b>دى كلام للاستاذ عمر يعدل عليه</b>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="has-text-centered">
    <button class="button is-large is-info" id="btnPrint" v-if="highSchool.length >= 1">طباعة</button>
</div>
<!-- END Print Card -->