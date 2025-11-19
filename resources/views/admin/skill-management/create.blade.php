@extends('admin.layout.app')

@section('title', 'Setting - Job Descriptions')

@section('styles')
<style>
    .btn-icon.btn-light-danger {
        border: 1px solid #f7941d;
        background-color: #fff5f0;
        color: #f1416c;
        padding: 0.35rem 0.6rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-icon.btn-light-danger:hover {
        background-color: #f1416c;
        color: #fff;
    }

    .input-group-text i {
        color: #f7941d;
    }

    .level-card {
        border: 2px dashed #f7941d;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 6px;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    <form action="{{ route('skill.management.store') }}" method="POST">
        @csrf
        <input type="hidden" name="custom" value="1">
        <div class="card mb-4">
            <div class="card-header mt-3">
                <h3>Add Technical Skill</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Technical Skill Title</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Technical Skill Description</label>
                    <textarea name="description" id="description" rows="3" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Technical Skill Category</label>
                    <select name="category_id" id="category" class="form-select" required>
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h4>Levels</h4>
            </div>
            <div class="card-body">
                <div class="dropdown mb-3">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="addLevelDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Add Level
                    </button>
                    <ul class="dropdown-menu" id="levelDropdownList">
                        @for ($i = 1; $i <= 6; $i++)
                            <li><a class="dropdown-item" href="#" data-level="{{ $i }}">Level {{ $i }}</a></li>
                        @endfor
                    </ul>
                </div>
                <div id="selectedLevels"></div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <label class="form-label fw-bold text-dark">Create Technical Skill?</label>
                <div class="d-flex gap-2 mt-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="" class="btn btn-danger"><i class="bi bi-trash me-1"></i> Discard</a>
                </div>
            </div>
        </div>
    </form>
</div>

<template id="levelTemplate">
    <div class="level-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="level-title">Level</h5>
            <button type="button" class="btn btn-sm btn-light-danger remove-level"><i class="bi bi-trash"></i></button>
        </div>

        <div class="mb-3">
            <label class="form-label">Level Description</label>
            <input type="text" class="form-control level-desc-input" placeholder="Level Description">
        </div>

        <div class="mb-3">
            <label class="form-label">Knowledge</label>
            <div class="knowledge-group"></div>
            <button type="button" class="btn btn-sm btn-primary add-knowledge mt-2">+ Add Knowledge</button>
        </div>

        <div class="mb-3">
            <label class="form-label">Abilities</label>
            <div class="ability-group"></div>
            <button type="button" class="btn btn-sm btn-primary add-ability mt-2">+ Add Ability</button>
        </div>
    </div>
</template>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('#levelDropdownList .dropdown-item').forEach(function (item) {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            const level = this.getAttribute('data-level');
            if (document.querySelector(`#level-card-${level}`)) return;

            const template = document.querySelector('#levelTemplate');
            const clone = template.content.cloneNode(true);
            const levelCard = clone.querySelector('.level-card');
            levelCard.id = `level-card-${level}`;
            clone.querySelector('.level-title').textContent = `Level ${level}`;

            // Assign correct name for description
            const descInput = clone.querySelector('.level-desc-input');
            descInput.name = `level_${level}_description`;

            const knowledgeGroup = clone.querySelector('.knowledge-group');
            const abilityGroup = clone.querySelector('.ability-group');

            const createInputRow = (group, type) => {
                const existing = group.querySelectorAll('input').length;
                if (existing >= 6) return;

                const row = document.createElement('div');
                row.className = 'd-flex align-items-center mb-2';
                row.innerHTML = `
                    <input type="text" class="form-control me-2" name="level_${level}_${type}[]" placeholder="Enter ${type.charAt(0).toUpperCase() + type.slice(1)}">
                    <button type="button" class="btn btn-icon btn-light-danger" onclick="this.parentElement.remove()">
                        <i class="bi bi-trash"></i>
                    </button>
                `;
                group.appendChild(row);
            };

            createInputRow(knowledgeGroup, 'knowledge');
            createInputRow(abilityGroup, 'ability');

            clone.querySelector('.add-knowledge').addEventListener('click', function () {
                createInputRow(knowledgeGroup, 'knowledge');
            });

            clone.querySelector('.add-ability').addEventListener('click', function () {
                createInputRow(abilityGroup, 'ability');
            });

            clone.querySelector('.remove-level').addEventListener('click', function () {
                this.closest('.level-card').remove();
            });

            document.getElementById('selectedLevels').appendChild(clone);
        });
    });
</script>
@endsection
