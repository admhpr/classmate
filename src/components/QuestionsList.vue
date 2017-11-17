// potential template
<ul>
    <li v-for="question in questions">
        <div class="well">
        <h3>{{ question.title }}</h3>
        <small>Asked: {{ question.date_created }}</small>
        <span class="pull-right">Category: <h4><mark>{{ question.category }}</mark></h4></span>
        <hr>
        <p>{{ question.content }}</p>
        <a class="btn btn-primary"  :href="<?= ROOT_PATH ?> + 'questions/'  + question.id" target="_blank">View Answers</a>
        </div>
    </li>
</ul>