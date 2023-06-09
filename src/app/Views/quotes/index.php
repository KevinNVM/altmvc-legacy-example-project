<h1>Quotes</h1>
<a href="javascript:history.back()">Go Back</a>

<hr />

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createQuoteModal">
    Create New Quote
</button>

<div class="modal fade" id="createQuoteModal" tabindex="-1" aria-labelledby="createQuoteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createQuoteModalLabel">Create New Quote</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div x-data="{formData: {}}">
                    <form
                        @submit.prevent="fetch('<?= url('/quotes') ?>', {method: 'post', body: JSON.stringify(formData)}).then(e => location.reload())">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Enter Quote"
                                required x-model="formData.text">
                            <label for="floatingInput">Quote</label>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="d-flex flex-column gap-4">

    <?php foreach ($quotes as $key => $quote): ?>

        <div class="d-flex justify-content-between align-items-center" x-data="{editMode: false}">
            <blockquote class="blockquote w-full">
                <p>
                    <?= $quote->text ?>
                </p>
                <span>-
                    <?= $quote->author ?>
                </span>
            </blockquote>
            <button class="btn btn-sm btn-danger"
                @click="fetch('<?= url("/quotes/$quote->id") ?>', {method: 'delete'}).then(e => location.reload())">
                Delete
            </button>
        </div>

    <?php endforeach; ?>
</div>