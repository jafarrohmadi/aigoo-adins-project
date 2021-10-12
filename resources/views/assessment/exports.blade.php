
<table>
    <tr>
        <td></td>
    </tr>
</table>

<table>
    <tr>
        <td></td>
        <td></td>
        <td>User</td>
        <td>{{ $assessmentMonts->first()->user->name }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Periode</td>
        <td>{{ date('F Y', strtotime($assessmentMonts->first()->assessment_year_month)) }}</td>
    </tr>
</table>

<table>
    <thead>
    <tr>
        <th></th>
        <th>No</th>
        <th>Assessment</th>
        @foreach ($assessmentMonts as $dataUser)
            <th> {{ $dataUser->assessor->name}} </th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($assessment as $key => $assessments)
        <tr>
            <td></td>
            <td> {{$key + 1}}</td>
            <td>{{ $assessments->content }}</td>
            @foreach($assessmentMonts as $dataUser)

                <?php $assessmentData = \App\Models\Assessment::where([
                    'assessor_id'           => $dataUser->assessor_id,
                    'user_id'               => $dataUser->user_id,
                    'assessment_year_month' => $dataUser->assessment_year_month,
                ])->where('assessment_info', null)->with('question')->get();?>

                @foreach($assessmentData as $assessmentFinal)
                    @if($assessmentFinal->question_id == $assessments->id)
                        <td>{{ $assessmentFinal->value }} </td>
                    @endif
                @endforeach
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
