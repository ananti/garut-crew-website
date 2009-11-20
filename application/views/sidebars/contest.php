<div class="sidebar_block">
    <?//<h2>Contest Menu</h2>?>
    <h2><?=$this->contest->name?></h2>
    <ul>
        <?if($this->auth_user->is_owning($this->contest->id)):?>
        <li><?=html::anchor(url::site('contest/' . $this->contest->id),'Contest Home')?></li>
        <li><?=html::anchor(url::site('contest/news').'', 'News')?></li>
        <li><?=html::anchor(url::site('contest/users'), 'User')?></li>
        <li><?=html::anchor(url::site('contest/manage'), 'Management')?></li>
        <li><?=html::anchor(url::site('contest/problems'), 'Problems')?></li>
        <li><?=html::anchor(url::site('contest/submissions'), 'Submissions')?></li>
        <li><?=html::anchor(url::site('contest/clarifications'), 'Clarifications')?></li>
        <li><?=html::anchor(url::site('contest/ranks'), 'Ranks')?></li>
        <li><?=html::anchor(url::site('contest/ranks/index/open'), 'Today\'s Ranks')?></li>
        <?elseif ($this->auth_user->is_supervising($this->contest->id)):?>
        <li><?=html::anchor(url::site('contest/' . $this->contest->id),'Contest Home')?></li>
        <li><?=html::anchor(url::site('contest/problems'), 'Problems')?></li>
        <li><?=html::anchor(url::site('contest/submissions'), 'Submissions')?></li>
        <li><?=html::anchor(url::site('contest/clarifications'), 'Clarifications')?></li>
        <li><?=html::anchor(url::site('contest/ranks'), 'Ranks')?></li>
        <li><?=html::anchor(url::site('contest/ranks/index/open'), 'Today\'s Ranks')?></li>
        <?elseif ($this->auth_user->is_participating($this->contest->id)) : ?>
        <li><?=html::anchor(url::site('contest/' . $this->contest->id), 'Contest Home')?></li>
        <li><?=html::anchor(url::site('contest/problems'), 'Problems')?></li>
        <li><?=html::anchor(url::site('contest/submissions'), 'Submissions')?></li>
        <li><?=html::anchor(url::site('contest/clarifications'), 'Clarifications')?></li>
        <li><?=html::anchor(url::site('contest/ranks'), 'Ranks')?></li>
        <li><?=html::anchor(url::site('contest/ranks/index/open'), 'Today\'s Ranks')?></li>
        <?elseif ($this->auth_user->has_role('learner') && ($this->contest->status == Contest_Model::CONTEST_STATUS_OPEN)):?>
        <li><?=html::anchor(url::site('contest/home/register'), 'Register')?></li>
        <?endif;?>
    </ul>
</div>
