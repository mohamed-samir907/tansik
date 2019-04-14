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