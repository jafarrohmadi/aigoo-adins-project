
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
        <td style="background: orange">Department</td>
        <td style="background: orange">{{ $assessmentMonts->first()->user->department }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td style="background: orange">Periode</td>
        <td style="background: orange">{{ date('F Y', strtotime($assessmentMonts->first()->assessment_year_month)) }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        @foreach ($assessmentMonts as $assessments)
            <td style="background: orange">
                @if($assessments->user->id == $assessments->assessor->id)
                    Diri Sendiri
                @else
                    @if($assessments->assessor->id == $assessments->user->supervisor_id)
                        Atasan 1 Tim
                    @endif

                    @if($assessments->assessor->supervisor_id == $assessments->user->id)
                        Bawahan 1 Tim
                    @endif

                    @if($assessments->user->department == $assessments->assessor->department)
                        Peer Satu Tim
                    @endif

                    @if($assessments->user->department != $assessments->assessor->department)
                        Peer Beda Tim
                    @endif
                @endif
            </td>
        @endforeach
    </tr>

    <tr>
        <th></th>
        <th>No</th>
        <th style="background: orange">Cluster</th>
        <th>Assessment</th>
        @foreach ($assessmentMonts as $dataUser)
            <th> {{ $dataUser->assessor->name}} </th>
        @endforeach
    </tr>

    @foreach($assessment as $key => $assessments)
        <tr>
            <td></td>
            <td> {{$key + 1}}</td>
            <td> {{$assessments->categoryData->name ?? 'No Category'}}</td>
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

</table>
