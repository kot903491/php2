<a href="lesson3.php">На главную</a>
<div id="gallery">
{% for img in image %}
<div class="img"><div>
        <a href="lesson3.php?page={{img.id}}">
            <img src="{{img.img}}" alt="{{img.name}}">
        </a>
    </div>
</div>
{% endfor %}
</div>
<div style="clear:both;"></div>