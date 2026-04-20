<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 12px;
        }

        .center {
            text-align: center;
        }

        .title {
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
        }

        .line {
            border-bottom: 1px solid black;
            display: inline-block;
            min-width: 150px;
        }

        table {
            width: 100%;
        }

        td {
            padding: 4px;
            vertical-align: top;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="center">
        <strong>PROVINCIAL REHABILITATION AND CIVIL SECURITY DIVISION</strong><br>
        Provincial Administrator's Office<br>
        Nabunturan, Davao de Oro
    </div>

    <div style="text-align:right;">
        DATE: {{ $data['date'] ?? '' }}
    </div>

    <h3 class="title">JAIL BOOKING REPORT</h3>

    <!-- BASIC INFO -->
    <table>
        <tr>
            <td>ID NO: <span class="line">{{ $data['id'] ?? '' }}</span></td>
            <td>SEX: <span class="line">{{ $data['sex'] ?? '' }}</span></td>
            <td>AGE: <span class="line">{{ $data['age'] ?? '' }}</span></td>
        </tr>

        <tr>
            <td colspan="3">
                NAME: <span class="line" style="width:400px;">
                    {{ $data['name'] ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>OFFENSE: <span class="line">{{ $data['offense'] ?? '' }}</span></td>
            <td>HEIGHT: <span class="line">{{ $data['height'] ?? '' }}</span></td>
            <td>WEIGHT: <span class="line">{{ $data['weight'] ?? '' }}</span></td>
        </tr>

        <tr>
            <td>RELIGION: <span class="line">{{ $data['religion'] ?? '' }}</span></td>
            <td>HAIR: <span class="line">{{ $data['hair'] ?? '' }}</span></td>
            <td>COMPLEXION: <span class="line">{{ $data['complexion'] ?? '' }}</span></td>
        </tr>

        <tr>
            <td colspan="3">
                ADDRESS: <span class="line" style="width:400px;">
                    {{ $data['address'] ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                OCCUPATION: <span class="line">{{ $data['occupation'] ?? '' }}</span>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                CIVIL STATUS: <span class="line">{{ $data['civil_status'] ?? '' }}</span>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                FATHER: <span class="line">{{ $data['father'] ?? '' }}</span>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                MOTHER: <span class="line">{{ $data['mother'] ?? '' }}</span>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                IDENTIFYING MARK: 
                <span class="line">
                    {{ $data['mark'] ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                CIRCUMSTANCES: 
                <span class="line">
                    {{ $data['circumstances'] ?? '' }}
                </span>
            </td>
        </tr>
    </table>

    <br><br>

    <!-- EXTRA DETAILS (FROM YOUR FULL DATA) -->
    <table>
        <tr>
            <td>CASE NO: <span class="line">{{ $data['case_no'] ?? '' }}</span></td>
            <td>ALIAS: <span class="line">{{ $data['alias'] ?? '' }}</span></td>
        </tr>

        <tr>
            <td>BIRTHDATE: <span class="line">{{ $data['birthdate'] ?? '' }}</span></td>
            <td>PLACE OF BIRTH: <span class="line">{{ $data['place_of_birth'] ?? '' }}</span></td>
        </tr>

        <tr>
            <td>ETHNICITY: <span class="line">{{ $data['ethnicity'] ?? '' }}</span></td>
            <td>SKILLS: <span class="line">{{ $data['skills'] ?? '' }}</span></td>
        </tr>

        <tr>
            <td colspan="2">
                EDUCATIONAL ATTAINMENT:
                <span class="line">{{ $data['educ_attainment'] ?? '' }}</span>
            </td>
        </tr>

        <tr>
            <td>COURT: <span class="line">{{ $data['court_name'] ?? '' }}</span></td>
            <td>JUDGE: <span class="line">{{ $data['judge'] ?? '' }}</span></td>
        </tr>

        <tr>
            <td>DATE RECEIVED: <span class="line">{{ $data['date_received'] ?? '' }}</span></td>
            <td>STATION: <span class="line">{{ $data['station'] ?? '' }}</span></td>
        </tr>

        <tr>
            <td>ENDORSED BY: <span class="line">{{ $data['endorsing_officer'] ?? '' }}</span></td>
            <td>VISITED: <span class="line">{{ $data['visited'] ?? '' }}</span></td>
        </tr>
    </table>

    <br><br>

    <!-- SIGNATURES -->
    <table>
        <tr>
            <td class="center">
                {{ $data['receiving_officer'] ?? '' }}<br>
                <small>Receiving Officer</small>
            </td>

            <td class="center">
                {{ $data['admin'] ?? '' }}<br>
                <small>Chief Admin</small>
            </td>
        </tr>
    </table>

    <br><br>

    <div class="center">
        {{ $data['warden'] ?? '' }}<br>
        <small>Provincial Warden</small>
    </div>

</body>
</html>