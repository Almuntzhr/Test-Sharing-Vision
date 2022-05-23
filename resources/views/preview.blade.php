<!DOCTYPE html>
<html>
    <head>
        <style>
            /* Add a card effect for articles */
            .card {
                background-color: white;
                padding: 20px;
                margin-top: 20px;
            }

        </style>
    </head>
<body>
    <div class="row">
        <div class="card">
            <h2>{{ $model->title }}</h2>
            <h5>{{ $model->category}}, {{ date('M d, Y', strtotime($model->created_at)) }}</h5>
            <p>{{ $model->content }}</p>
        </div>
    </div>
</body>
</html>