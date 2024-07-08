<?php

namespace App\Http\Livewire\CmsPage;

use App\Models\CmsPage;
use Livewire\Component;

class Edit extends Component
{
    public CmsPage $cmsPage;

    public function mount(CmsPage $cmsPage)
    {
        $this->cmsPage = $cmsPage;
    }

    public function render()
    {
        return view('livewire.cms-page.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->cmsPage->save();

        return redirect()->route('admin.cms-pages.index');
    }

    protected function rules(): array
    {
        return [
            'cmsPage.name' => [
                'string',
                'nullable',
            ],
            'cmsPage.publish' => [
                'boolean',
            ],
            'cmsPage.slug' => [
                'string',
                'nullable',
            ],
            'cmsPage.description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
