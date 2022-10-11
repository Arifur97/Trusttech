<div id="video" class="tab-pane video" :class="{ active: activeTab === 'video' }">
    <div style="margin-top: 20px;"></div>
    <div class="video-inner">
        <iframe width="100%" height="450px" src="{{ 'https://www.youtube.com/embed/' . $product->video_url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</div>