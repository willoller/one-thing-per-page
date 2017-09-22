<div style="border: 1px solid #999; padding: 4px; height: 15em;" class="hidden-xs" ng-hide="pages.length">
  <a
    style="height: 100%;
      display: block;
      background: white url(/images/indexcards.jpg) center center no-repeat"
    href="/buy-index-cards">

    <p style="padding: 20px;">

      <?php if (rand(0,1) > 0.5) : ?>
        <span style="background: #666; background: rgba(0,0,0,0.75); color: white; font-style: oblique; font-weight: 900; font-size: 175%;">
          Wait! Do you need some more index cards?
        </span>
      <?php else : ?>
        <span style="background: #357ebd; color: white; font-style: oblique; font-weight: 900; font-size: 175%; ">
          Buy 500 Oxford Ruled 5x8 Index Cards
        </span>
      <?php endif; ?>

    </p>
  </a>
</div>