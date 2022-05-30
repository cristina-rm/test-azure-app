<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ParentComponent extends Component
{
    public $showIsOpen = 0;
    public $editIsOpen = 0;
    public $createIsOpen = 0;
    public $privacyIsOpen = 0;
    public $confirmDeleteIsOpen = 0;

    protected $listeners = [
        'showAction' => 'show',
        'editAction' => 'edit',
        'deleteAction' => 'delete',
        'restoreAction' => 'restore',
        'privacyAction' => 'privacy',
        'confirmDeleteAction' => 'confirmDelete'
    ];

    /**
     * Trigger open show modal window.
     */
    public function openShowModal()
    {
        $this->showIsOpen = true;
    }

    /**
     * Trigger close show modal window
     */
    public function closeShowModal()
    {
        $this->showIsOpen = false;
    }

    /**
     * Trigger open create modal window
     */
    public function openCreateModal()
    {
        $this->createIsOpen = true;
    }

    /**
     * Trigger close create modal window
     */
    public function closeCreateModal()
    {
        $this->createIsOpen = false;
    }

    /**
     * Trigger open edit modal window
     */
    public function openEditModal()
    {
        $this->editIsOpen = true;
    }

    /**
     * Trigger close edit modal window
     */
    public function closeEditModal()
    {
        $this->editIsOpen = false;
    }

    /**
     * Trigger open edit modal window
     */
    public function openConfirmDeleteModal()
    {
        $this->confirmDeleteIsOpen = true;
    }

    /**
     * Trigger close edit modal window
     */
    public function closeConfirmDeleteModal()
    {
        $this->confirmDeleteIsOpen = false;
    }

    /**
     * Trigger open edit modal window
     */
    public function openPrivacyModal()
    {
        $this->privacyIsOpen = true;
    }

    /**
     * Trigger close edit modal window
     */
    public function closePrivacyModal()
    {
        $this->privacyIsOpen = false;
    }
}
