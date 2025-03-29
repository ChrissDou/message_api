<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Messages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="messages form content">
            <?= $this->Form->create($message) ?>
            <fieldset>
                <legend><?= __('Add Message') ?></legend>
                <?php
                    echo $this->Form->control('username', [
                        'maxlength' => 20,
                        'placeholder' => 'Enter your name (max 20 characters)',
                        'required' => true,
                        'help' => 'Max 20 characters.'
                    ]);

                    echo $this->Form->control('message', [
                        'type' => 'textarea',
                        'maxlength' => 200,
                        'placeholder' => 'Write your message here...',
                        'required' => true,
                        'help' => 'Message must be under 200 characters.'
                    ]);

                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
