<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://unpkg.com/tabulator-tables@5.5.3/dist/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@5.5.3/dist/js/tabulator.min.js"></script>
</head>

<body>
    <div>
        <table id="example-table">
            <thead>
                <tr>
                    <th width="200">Name</th>
                    <th tabulator-hozAlign="center">Progress</th>
                    <th>Gender</th>
                    <th>Height</th>
                    <th width="150">Favourite Color</th>
                    <th>Date of Birth</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Billy Bob</td>
                    <td>12</td>
                    <td>male</td>
                    <td>1</td>
                    <td>red</td>
                    <td>22/04/1994</td>
                </tr>
                <tr>
                    <td>Mary May</td>
                    <td>1</td>
                    <td>female</td>
                    <td>2</td>
                    <td>blue</td>
                    <td>14/05/1982</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        var table = new Tabulator("#example-table", {
            movableRows: true,
            columns: [{
                    formatter: "rowSelection",
                    titleFormatter: "rowSelection",
                    hozAlign: "center",
                    headerSort: false,
                    cellClick: function(e, cell) {
                        cell.getRow().toggleSelect();
                    }
                },
                {
                    title: "Name",
                    field: "name",
                    width: 200
                },
                {
                    title: "Progress",
                    field: "progress",
                    width: 100,
                    hozAlign: "right",
                    sorter: "number"
                },
                {
                    title: "Gender",
                    field: "gender",
                    width: 100
                },
                {
                    title: "Rating",
                    field: "rating",
                    hozAlign: "center",
                    width: 80
                },
                {
                    title: "Favourite Color",
                    field: "col"
                },
                {
                    title: "Date Of Birth",
                    field: "dob",
                    hozAlign: "center",
                    sorter: "date"
                },
                {
                    title: "Driver",
                    field: "car",
                    hozAlign: "center",
                    width: 100
                },
            ],
        });
    </script>
</body>

</html>