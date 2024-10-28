<h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 tracking-tight text-center md:text-left border-b border-gray-400 pb-2">
    <?php echo $title; ?>
</h1>

<?php foreach ($list as $file): ?>
    <?php if ($file != '.' && $file != '..'): ?>
            <div class="flex items-center justify-between gap-3 bg-gray-100 p-4 rounded-lg">
                <img src="/images/<?= $file ?>" alt="<?= $file ?>" class="w-1/4">
            </div>
<?php endif;
endforeach; ?>