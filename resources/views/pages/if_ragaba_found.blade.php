<h5 class="has-text-centered">
    <span>تعديل الرغبات</span>
</h5>
<div class="has-background-light"
    style="margin-top: 15px; margin-bottom: 10px; padding: 10px">
    <form method="POST" action="{{ route('front.edit_ragaba') }}">
        <div class="row justify-content-left">
            {{ csrf_field() }}
            
            @if($ragabas->count() > 1)
            <table>
                <tr>
                    <td class="col s12" style="display: block;">
                        <label for="editRagabasSelect" style="font-weight: bold">اختر التصنيف</label>
                        <select name="type" size="5" id="editRagabasSelect" @change="editRagabas"
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
            </table>
            @endif

            <table>
                <tbody id="editRagabasTable">
                    @if($ragabas->count() > 0)
                        @foreach($ragabas as $school)
                            @if($ragabas->count() == 1)
                                <input type="hidden" name="type" value="high">
                            @endif
                            <tr id="tr-{{ $school->id }}">
                                <td>
                                    <input type="hidden" name="school[]" value="{{ $school->id }}">
                                    {{ $school->name }}
                                </td>
                                <td>
                                    <button data-id="{{ $school->id }}" class="button is-danger is-outlined is-small" id="btn-edit-delete">×</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>

            </table>
            <input class="button is-success" type="submit" value="تأكيد الرغبات">
        </div>
    </form>
</div>
