@props(['hasMember' => false])

<div
    class="modal-overlay"
    data-membership-modal
    data-show-if-unanswered="{{ $hasMember ? '0' : '1' }}"
>
    <div class="modal-sheet">

        <div data-modal-step="ask">
            <h2 class="modal-sheet__title font-display">{{ __('Do you have a membership?') }}</h2>
            <p class="modal-sheet__desc">{{ __('Let us know if you already have a membership at Ascend.') }}</p>

            <div class="modal-sheet__actions">
                <button type="button" class="modal-btn modal-btn--primary" data-modal-answer="yes">
                    {{ __('Yes, I have a membership') }}
                </button>
                <button type="button" class="modal-btn modal-btn--secondary" data-modal-answer="no">
                    {{ __('No, not yet') }}
                </button>
            </div>
        </div>

        <div data-modal-step="yes" style="display: none;">
            <h2 class="modal-sheet__title font-display">{{ __('Almost there') }}</h2>
            <p class="modal-sheet__desc">
                {{ __('An administrator needs to link your existing membership to this account. Visit the front desk or contact staff, and they\'ll connect it for you — this keeps your membership secure.') }}
            </p>

            <div class="modal-sheet__actions">
                <button type="button" class="modal-btn modal-btn--primary" data-modal-done>
                    {{ __('Got it') }}
                </button>
            </div>
        </div>

    </div>
</div>